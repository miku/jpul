#!/usr/bin/env python

import json, os, csv

cumulative = 0

# csv_writer = csv.writer(
# 	open('charts.csv', 'wb'), delimiter=',')

for i in range(61, 1010):
	if os.path.exists('downloads/{0}.json'.format(i)):
		j = json.load(open('downloads/{0}.json'.format(i)))
		print j['view_count'], j['date_added'], j['company'].encode('utf-8'), j['title'].encode('utf-8'), j['id']
		# csv_writer.writerow([j['view_count'], j['date_added'], 
		# 	j['company'].encode('utf-8'), 
		# 	j['title'].encode('utf-8'), j['id']])
		cumulative += int(j['view_count'])





