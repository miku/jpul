#!/usr/bin/env python
# -*- coding: utf-8 -*-

"""
Find matching DB and FS dumps.
"""

import datetime
import os
import re
import sys

FS_DUMP_PREFIX = 'webdir'
DB_DUMP_PREFIX = 'jobportal'

def find_closest(prefix, target_ts):
	closest_fn, distance = None, sys.maxint
	for fn in filter(lambda x: x.startswith(prefix), os.listdir('.')):
		try:
			timestamp = re.search("\d{10,10}", fn).group()
		except AttributeError:
			continue
		diff = abs(int(target_ts) - int(timestamp))
		if diff < distance:
			closest_fn, distance = fn, diff
	print closest_fn.ljust(35), '%.2f' % (distance / 60), 'minute(s) away'

def main(filename):
	""" Extract 1303313960 like string from filename"""
	timestamp = re.search("\d{10,10}", filename).group()
	if not timestamp:
		raise Exception("No file matching \d{10,10}.")
	print 'Target: %s (%s)\n' % (timestamp, datetime.datetime.fromtimestamp(int(timestamp)).isoformat())
	find_closest(FS_DUMP_PREFIX, timestamp)
	find_closest(DB_DUMP_PREFIX, timestamp)

if __name__ == '__main__':
	try:
		main(sys.argv[1])
	except IndexError:
		print 'Find matching DB and FS dump files.'
		print 'Usage: %s [FILENAME]' % (os.path.basename(sys.argv[0]))
