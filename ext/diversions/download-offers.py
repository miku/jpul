#!/usr/bin/env python

"""
Download json job offer descriptions via API.

!!! Functioning, but hardwired values, so a little useless for now.
"""

import urllib, os, time

boot_url = "http://wwwdup.uni-leipzig.de/jobportal/api/jobs?since_id=0&expired=1"

for i in range(1200):
    if os.path.exists('downloads/{0}.json'.format(i)):
        print "{0} already downloaded.".format(i)
        continue
    urlinfo = urllib.urlopen("http://wwwdup.uni-leipzig.de/jobportal/api/job/{0}".format(i))
    if urlinfo.code == 404:
        print "{0} doesn't exist.".format(i)
        time.sleep(0.5)
    if urlinfo.code == 200:
        handle = open('downloads/{0}.json'.format(i), 'w')
        handle.write(urlinfo.read())
        handle.close()
        print "Downloaded {0}.".format(i)
        time.sleep(0.5)
    