#!/usr/bin/env python
# -*- coding: utf-8 -*-

import json
import os
import re
import subprocess
import sys
import urllib

BASEURL= 'http://wwwdup.uni-leipzig.de/jobportal/job/index?'
BASEURL_JOBS = 'http://wwwdup.uni-leipzig.de/jobportal/job'
BASEURL= 'http://localhost:10000/job/index?'

class bcolors:
	HEADER = '\033[95m'
	OKBLUE = '\033[94m'
	OKGREEN = '\033[92m'
	FAIL = '\033[91m'
	ENDC = '\033[0m'

	def disable(self):
		self.HEADER = ''
		self.OKBLUE = ''
		self.OKGREEN = ''
		self.FAIL = ''
		self.ENDC = ''

def main(args):
	""" Example usage of experimenatal jobportal API. 
	"""
	query = urllib.urlencode(
		{'ipp' : 20, 'v' : 'json', 'q' : ' '.join(args) })
	result = json.loads(
		urllib.urlopen("{0}?v=json&{1}".format(BASEURL, query)).read())

	if not result:
		print 'Keine Angebote gefunden für:', bcolors.FAIL, ' '.join(args), \
			bcolors.ENDC
		return
	
	print bcolors.OKGREEN
	print "{0} Jobs gefunden.\n".format(len(result)), bcolors.ENDC
	
	shard = result[0]['date']
	for item in result:
		if item['date'] != shard:
			shard = item['date']
			print '-' * (len(item['id'] + item['date']) + 2)
		try:
			print item['id'], bcolors.OKGREEN, item['date'], \
				bcolors.ENDC, item['title'].encode('utf-8')
		except KeyError, ke:
			print item

	print '\nWeitere Angebote unter http://www.uni-leipzig.de/jobportal\n'

def open(handle):
	p = subprocess.Popen("open " + handle, shell=True)
	sts = os.waitpid(p.pid, 0)[1]

if __name__ == '__main__':
	if len(sys.argv) == 2 and re.match(r'^\d+$', sys.argv[1].strip()):
		open("{0}/{1}".format(BASEURL_JOBS, sys.argv[1]))
	else:
		main(sys.argv[1:])
