#!/usr/bin/env python

import json, os, csv

cumulative = 0

filename = '2011_05_18_Jobportal_Charts.csv'

csv_writer = csv.writer(
	open(filename, 'wb'), delimiter=',')

for i in range(61, 1200):
	if os.path.exists('downloads/{0}.json'.format(i)):
		j = json.load(open('downloads/{0}.json'.format(i)))
		# print j['view_count'], j['date_added'], j['company'].encode('utf-8'), j['title'].encode('utf-8'), j['id']
		csv_writer.writerow([j['view_count'], j['date_added'], 
			j['company'].encode('utf-8'), 
			j['title'].encode('utf-8'), j['id']])
		cumulative += int(j['view_count'])

# print cumulative