package de.uleipzig.jobportal;

import java.io.File;
import java.io.IOException;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Set;
import org.apache.commons.cli.CommandLine;
import org.apache.commons.cli.CommandLineParser;
import org.apache.commons.cli.GnuParser;
import org.apache.commons.cli.Option;
import org.apache.commons.cli.OptionBuilder;
import org.apache.commons.cli.Options;
import org.apache.commons.cli.ParseException;
import org.apache.lucene.document.Document;
import org.apache.lucene.index.IndexReader;
import org.apache.lucene.index.TermFreqVector;
import org.apache.lucene.search.IndexSearcher;
import org.apache.lucene.search.Query;
import org.apache.lucene.search.TopDocs;
import org.apache.lucene.search.similar.MoreLikeThis;
import org.apache.lucene.store.Directory;
import org.apache.lucene.store.FSDirectory;

/**
 * Main.
 *
 */
public class Main {
    
    private static final String DEFAULT_INDEX = "/Users/ronit/gh/miku-jpul/protected/runtime/search";

    public static void main(String[] args) throws ParseException, IOException {

        Options options = new Options();
        Option indexOption = OptionBuilder.withArgName("index").hasArg().withDescription("Index directory").create("index");
        Option docOption = OptionBuilder.withArgName("doc").hasArg().withDescription("Target document").create("doc");
        
        options.addOption(indexOption);
        options.addOption(docOption);

        CommandLineParser parser = new GnuParser();
        CommandLine line = null;
        
        try {
            line = parser.parse(options, args);
        } catch (ParseException exp) {
            System.err.println("Parsing failed.  Reason: " + exp.getMessage());

        }

        String indexDir;

        if (line.hasOption("index")) {
            // initialise the member variable
            indexDir = line.getOptionValue("index");
            System.out.println("Using Index: " + indexDir);
        } else {
            indexDir = DEFAULT_INDEX;
        }

        Directory dir = FSDirectory.open(new File(indexDir));
        IndexSearcher is = new IndexSearcher(dir);
        IndexReader ir = is.getIndexReader();
        
        System.out.println("IndexReader is of class: " + ir.getClass().getCanonicalName());

        System.err.println("Index: " + ir.directory());
        System.err.println("Index version: " + ir.getVersion());
        System.err.println("Number of documents: " + ir.numDocs());

        HashMap<String, Integer> jobMap = new HashMap<String, Integer>();

        System.err.print("Job identifier (choose one as argument for --doc): ");
        for (int i = 0; i < ir.maxDoc(); i++) {
            if (ir.isDeleted(i)) {
                continue;
            }
            Document doc = ir.document(i);
            String jobId = doc.get("pk");
            jobMap.put(jobId, i);
            System.out.print(jobId);
            if (i < ir.maxDoc() - 1) {
                System.out.print(", ");
            }
        }
        System.out.println();

        if (line.hasOption("doc")) {
            String requestedJob = line.getOptionValue("doc");
            if (!jobMap.containsKey(requestedJob)) {
                System.err.println("=> " + requestedJob + ": No such job");
            } else {

                System.err.println("\nFinding documents similar to:");

                int docId = jobMap.get(requestedJob);

                Document target = ir.document(docId);
                System.out.println("=> " + requestedJob + ", " + target.getValues("title")[0]);

                MoreLikeThis mlt = new MoreLikeThis(ir);
                mlt.setFieldNames(new String[]{"title", "description"});

                mlt.setMaxDocFreqPct(70);
                mlt.setMinWordLen(3);
                mlt.setMinTermFreq(2);
                mlt.setMinDocFreq(2);

                System.out.println("\nJobId/DocId: " + requestedJob + "/" + docId);
                TermFreqVector tfv = ir.getTermFreqVector(docId, "title");
                if (tfv != null) {
                    System.out.println(tfv.getTerms());
                } else {
                    System.out.println("TermFreqVector == null");
                }

                mlt.setStopWords(stopwords);

                System.out.println("\n" + mlt.describeParams());

                Query query = mlt.like(docId);
                System.out.println("Query: " + query.toString() + "\n");

                TopDocs similarDocs = is.search(query, 5);

                if (similarDocs.totalHits == 0) {
                    System.err.println("None like this");
                }

                for (int i = 0; i < similarDocs.scoreDocs.length; i++) {
                    if (similarDocs.scoreDocs[i].doc != docId) {
                        Document doc = ir.document(similarDocs.scoreDocs[i].doc);
                        System.out.println("=> " + doc.getField("pk").stringValue() + ", " + doc.getValues("title")[0]);
                    }
                }

            }
        }
    }
    protected static Set<String> stopwords = createStopwords();

    private static Set<String> createStopwords() {
        Set stopwords = new HashSet();
        stopwords.add("aber");
        stopwords.add("als");
        stopwords.add("am");
        stopwords.add("an");
        stopwords.add("auch");
        stopwords.add("auf");
        stopwords.add("aus");
        stopwords.add("bei");
        stopwords.add("bin");
        stopwords.add("bis");
        stopwords.add("bist");
        stopwords.add("da");
        stopwords.add("dadurch");
        stopwords.add("daher");
        stopwords.add("darum");
        stopwords.add("das");
        stopwords.add("daß");
        stopwords.add("dass");
        stopwords.add("dein");
        stopwords.add("deine");
        stopwords.add("dem");
        stopwords.add("den");
        stopwords.add("der");
        stopwords.add("des");
        stopwords.add("dessen");
        stopwords.add("deshalb");
        stopwords.add("die");
        stopwords.add("dies");
        stopwords.add("dieser");
        stopwords.add("dieses");
        stopwords.add("doch");
        stopwords.add("dort");
        stopwords.add("du");
        stopwords.add("durch");
        stopwords.add("ein");
        stopwords.add("eine");
        stopwords.add("einem");
        stopwords.add("einen");
        stopwords.add("einer");
        stopwords.add("eines");
        stopwords.add("er");
        stopwords.add("es");
        stopwords.add("euer");
        stopwords.add("eure");
        stopwords.add("für");
        stopwords.add("hatte");
        stopwords.add("hatten");
        stopwords.add("hattest");
        stopwords.add("hattet");
        stopwords.add("hier");
        stopwords.add("hinter");
        stopwords.add("ich");
        stopwords.add("ihr");
        stopwords.add("ihre");
        stopwords.add("im");
        stopwords.add("in");
        stopwords.add("ist");
        stopwords.add("ja");
        stopwords.add("jede");
        stopwords.add("jedem");
        stopwords.add("jeden");
        stopwords.add("jeder");
        stopwords.add("jedes");
        stopwords.add("jener");
        stopwords.add("jenes");
        stopwords.add("jetzt");
        stopwords.add("kann");
        stopwords.add("kannst");
        stopwords.add("können");
        stopwords.add("könnt");
        stopwords.add("machen");
        stopwords.add("mein");
        stopwords.add("meine");
        stopwords.add("mit");
        stopwords.add("muß");
        stopwords.add("mußt");
        stopwords.add("musst");
        stopwords.add("müssen");
        stopwords.add("müßt");
        stopwords.add("nach");
        stopwords.add("nachdem");
        stopwords.add("nein");
        stopwords.add("nicht");
        stopwords.add("nun");
        stopwords.add("oder");
        stopwords.add("seid");
        stopwords.add("sein");
        stopwords.add("seine");
        stopwords.add("sich");
        stopwords.add("sie");
        stopwords.add("sind");
        stopwords.add("soll");
        stopwords.add("sollen");
        stopwords.add("sollst");
        stopwords.add("sollt");
        stopwords.add("sonst");
        stopwords.add("soweit");
        stopwords.add("sowie");
        stopwords.add("und");
        stopwords.add("uns");
        stopwords.add("unser");
        stopwords.add("unsere");
        stopwords.add("unseren");
        stopwords.add("unseres");
        stopwords.add("unter");
        stopwords.add("vom");
        stopwords.add("von");
        stopwords.add("vor");
        stopwords.add("wann");
        stopwords.add("warum");
        stopwords.add("was");
        stopwords.add("weiter");
        stopwords.add("weitere");
        stopwords.add("wenn");
        stopwords.add("wer");
        stopwords.add("werde");
        stopwords.add("werden");
        stopwords.add("werdet");
        stopwords.add("weshalb");
        stopwords.add("wie");
        stopwords.add("wieder");
        stopwords.add("wieso");
        stopwords.add("wir");
        stopwords.add("wird");
        stopwords.add("wirst");
        stopwords.add("wo");
        stopwords.add("woher");
        stopwords.add("wohin");
        stopwords.add("zu");
        stopwords.add("zum");
        stopwords.add("zur");
        stopwords.add("zwischen");
        stopwords.add("über");
        return stopwords;
    }
}
