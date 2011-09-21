#!/usr/bin/env python

import re
import os
import subprocess
import logging
import time
import datetime

FORMAT = '%(asctime)-15s [%(name)s] %(message)s'
logging.basicConfig(
	format=FORMAT, 
	datefmt='%d/%m/%Y %H:%M:%S',
	level=logging.INFO,
)
logger = logging.getLogger('screenielog')

MYSQL_HOME = "/Applications/MAMP/Library"
MYSQL_EXE = MYSQL_HOME + "/bin/mysql"
MYSQLDUMP_EXE = MYSQL_HOME + "/bin/mysqldump"
MYSQLIMPORT_EXE = MYSQL_HOME + "/bin/mysqlimport"
SOCKET = "/Applications/MAMP/tmp/mysql/mysql.sock"
DATABASE = "jobportal"
USERNAME = "dbjobportal"
PASSWORD = "cc04109"

GIT_REPO = "/Users/ronit/github/miku/jpul"

DUMP_DIRS = [
	"/Volumes/A3/Users/ronit/github/miku-jpul/dumps",
	"/Users/ronit/github/miku/jpul/dumps",
]

DUMP_REGEX = "jobportal\.[0-9]+\.sql(\.gz)?"

class CommandFailed(Exception):
	pass

class Command(object):
	def __init__(self, command):
		self.command = command
		self.logger = logging.getLogger('command')

	def execute(self, verbose=True):
		if verbose:
			self.logger.debug("{0}".format(self.command))
		p = subprocess.Popen(self.command, shell=True)
		sts = os.waitpid(p.pid, 0)[1]
		if not 0 == sts:
			raise CommandFailed("Command failed with {0}".format(sts))
		return sts

class Dump(object):
	def __init__(self, path=None):
		self.path = path
		self.name = os.path.basename(self.path)
		self.size = os.stat(self.path).st_size
		self.timestamp = self.extract_timestamp()
		self.date = datetime.date.fromtimestamp(self.timestamp) if self.timestamp else None
		self.logger = logging.getLogger('dump')
		with open(self.path, 'rb') as f:
			self.gzipped = ("\x1f\x8b" == f.read(2))

	def extract_timestamp(self):
		match = re.match(".*([0-9]{10,10}).*", self.path)
		if match:
			return int(match.group(1))
		return None

	def __str__(self):
		return self.path
		
	def nearest_commit(self):
		if self.date:
			p = subprocess.Popen(["GIT_DIR={0}/.git \
				git log --before={{{1}}} -n 1 | \
				grep ^commit | \
				awk '{{print $2}}'".format(GIT_REPO, self.date)], shell=True,
				stdin=subprocess.PIPE, stdout=subprocess.PIPE, 
				close_fds=True)
			(child_stdout, child_stdin) = (p.stdout, p.stdin)
			
			return child_stdout.read().strip()

	def import_to_db(self):
		# delete tables (http://www.thingy-ma-jig.co.uk/comment/7007)
		self.logger.debug("Dropping tables")
		try:
			Command("{0} --user {1} -p{2} --socket={3} --add-drop-table --no-data\
				{4} | grep ^DROP | mysql --socket={3} -u{1} -p{2} {4}".format(
				MYSQLDUMP_EXE, USERNAME, PASSWORD, SOCKET, DATABASE
				)).execute()
		except CommandFailed, cf:
			self.logger.error(cf)

		start = time.time()
		
		self.logger.info("Importing ({1:.2f}M): {0} ".format(self.path, self.size / 1048576.0))
		if self.gzipped:
			try:
				Command("gunzip < {0} | {1} --user={2} --password={3} {4}".format(
					self.path, MYSQL_EXE, USERNAME, PASSWORD, DATABASE
				)).execute()
				self.logger.info("Import in {0:2f} seconds.".format(time.time() - start))
			except CommandFailed, cf:
				self.logger.error(cf)
		else:
			try:
				Command("{0} --user={1} --password={2} {3} < {4}".format(
					MYSQL_EXE, USERNAME, PASSWORD, DATABASE, self.path
				)).execute()
			except CommandFailed, cf:
				self.logger.error(cf)

def filter_fun(regex):
	def filter_filename(file_or_path):
		return re.match(regex, os.path.basename(file_or_path))
	return filter_filename

def list_of_dumps():
	result = []
	for directory in DUMP_DIRS:
		result += map(lambda s: Dump(os.path.join(directory, s)),
			filter(filter_fun(DUMP_REGEX), os.listdir(directory)))
	return result

def dump_table():
	for dump in list_of_dumps():
		print dump.timestamp, dump.date, dump.nearest_commit()
	

if __name__ == '__main__':
	dump_table()
