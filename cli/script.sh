#!/bin/sh
#get the input file
echo "\033[1mSpecify input set >\033[0m";
read inputfile
echo "\033[1mSpecify amount >\033[0m";
read amount

#run for all algorithms
for i in mergesort quicksort heapsort
do
    echo "Running $i";
    for j in 0 0.001 0.01 0.025 0.05 0.1 0.25 0.5 0.75 1
    do
        echo "Starting $j";
        php run.php type="$i" amount="$amount" input="$inputfile" error="$j" &
    done
done