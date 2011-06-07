#!/usr/bin/env python
# -*- coding: utf-8 -*-

"""
Compute the similarity between two documents.

"""

import argparse
import json
import urllib
import nltk
import re
import operator

def filter_stems(wordlist):
    from nltk import SnowballStemmer
    stemmer = SnowballStemmer("german")
    return [ stemmer.stem(x) for x in wordlist ]

def filter_to_lower(wordlist):
    return [ x.lower() for x in wordlist ]

def filter_stopwords(wordlist):
    cleaned = []
    stopwords = nltk.corpus.stopwords.words('german')
    for word in wordlist:
        remove = False
        for stopword in stopwords:
            if word.encode('utf-8') == stopword:
                remove = True
        if not remove:
            cleaned.append(word)
    return cleaned

def filter_funny(wordlist):
    cleaned = []
    for word in wordlist:
        clean = re.sub('[(),;:\*]', '', word)
        if clean:
            cleaned.append(clean)
    return cleaned

def filter_tag(wordlist):
    cleaned = []
    for word in wordlist:
        clean = re.sub('<[^>]+>', '', word)
        if clean:
            cleaned.append(clean)
    return cleaned

def filter_chain(wordlist):
    return filter_tag(
            filter_funny(
                filter_stopwords(
                    filter_stems(
                        filter_to_lower(wordlist)))))

def compare(*docs):
    if len(docs) == 2:
        compare_two(*docs)
    else:
        raise NotImplementedError("Not yet implemented")

def compare_two(a, b):
    try:
        doc_0 = json.loads(urllib.urlopen('http://localhost:10000/api/job/{0}'.format(a)).read())
        doc_1 = json.loads(urllib.urlopen('http://localhost:10000/api/job/{0}'.format(b)).read())
    except ValueError, value_e:
        print value_e
        return
    tokenizer = nltk.WhitespaceTokenizer()

    # print '\nDocument 0 frequency dictionary'
    # print '-' * len('Document 0 frequency dictionary')
    
    print doc_0['title']
    list_0 = filter_chain(tokenizer.tokenize(doc_0['description']))
    freq_0 = nltk.FreqDist(list_0)
    # print freq_0
    
    # print '\nDocument 1 frequency dictionary'
    # print '-' * len('Document 0 frequency dictionary')
    
    print doc_1['title']
    list_1 = filter_chain(tokenizer.tokenize(doc_1['description']))
    freq_1 = nltk.FreqDist(list_1)
    # print freq_1

    terms = sorted(list(set(freq_0) | set(freq_1)))
    
    # print '\nTerm dictionary'
    # print '-' * len('Term dictionary')
    # print terms
    
    document_freq = {}
    for term in terms:
        for d in (freq_0, freq_1):
            if term in d:
                try:
                    document_freq[term] += 1
                except KeyError:
                    document_freq[term] = 1

    print '\nDocument frequency'
    print '-' * len('Document frequency')
    
    sorted_document_freq = sorted(document_freq.iteritems(), key=operator.itemgetter(1), reverse=True)
    print sorted_document_freq

def main():
    pass

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='Process some integers.')
    parser.add_argument('document_ids', metavar='N', type=int, nargs='+',
                   help='document id to include in comparison')

    args = parser.parse_args()
    compare(*args.document_ids)
