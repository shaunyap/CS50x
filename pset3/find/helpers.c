/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>
#include <stdio.h>

#include "helpers.h"


bool binSearch(int value, int values[], int min, int max) {

    if (max < min) {
        return false;
    } else {
        int midpoint = ((min+max)/2);
        
        if (values[midpoint] == value) {
            return true;
            
        } else if (values[midpoint] < value) {
            return binSearch(value, values, midpoint + 1, max);
            return 0;
            
        } else {
            return binSearch(value, values, min, midpoint - 1);
            return 0;
        }
    }
}

/**
 * Returns true if value is in array of n values, else false.
 */
bool search(int value, int values[], int n)
{
    int min = 0, max = n;
    if (binSearch(value, values, min, max)) {
        return true;
    } else {
        return false;
    }

}



/**
 * Sorts array of n values.
 */
void sort(int values[], int n)
{
    // TODO: implement an O(n^2) sorting algorithm
    int holding;
    do {
        holding = 0;
        for(int i = 1; i < n; i++) {
            if (values[i] < values[i-1]) {
                holding = values[i];
                values[i] = values[i-1];
                values[i-1] = holding;
            }
        }
    } while (holding > 0);

    return;
}