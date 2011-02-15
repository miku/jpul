#!/usr/bin/env python
# -*- coding: utf-8 -*-

"""
Beispielscript für Jobportal API
Siehe auch: http://wwwdup.uni-leipzig.de/jobportal/docs/embed.html

	$ ccjobs.py [QUERY]

"""

import json
import os
import re
import subprocess
import sys
import urllib

BASEURL = 'http://wwwdup.uni-leipzig.de/jobportal/job/index?'
BASEURL_JOBS = 'http://wwwdup.uni-leipzig.de/jobportal/job'

class Colors(object):
    """ http://stackoverflow.com/q/287871/89391 
    """
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'

def main(args):
    """ Example usage of experimenatal jobportal API. 
    """
    query = urllib.urlencode(
        {'ipp' : 20, 'v' : 'json', 'q' : ' '.join(args) })
    result = json.loads(
        urllib.urlopen("{0}?{1}".format(BASEURL, query)).read())

    if not result:
        print 'Keine Angebote gefunden für:', Colors.FAIL, ' '.join(args), \
            Colors.ENDC
        return
    
    print Colors.OKGREEN
    print "{0} Jobs gefunden.\n".format(len(result)), Colors.ENDC
    
    shard = result[0]['date']
    for item in result:
        if item['date'] != shard:
            shard = item['date']
            print '-' * (len(item['id'] + item['date']) + 2)
        try:
            print item['id'], Colors.OKGREEN, item['date'], \
                Colors.ENDC, item['title'].encode('utf-8')
        except KeyError:
            print item

    print '\nWeitere Angebote unter http://www.uni-leipzig.de/jobportal\n'

def open_browser(handle):
    """ On Mac OS X, `open` opens anything. 
    """
    process = subprocess.Popen("open " + handle, shell=True)
    _ = os.waitpid(process.pid, 0)[1]

if __name__ == '__main__':
    if len(sys.argv) == 2 and re.match(r'^\d+$', sys.argv[1].strip()):
        open_browser("{0}/{1}".format(BASEURL_JOBS, sys.argv[1]))
    else:
        main(sys.argv[1:])
