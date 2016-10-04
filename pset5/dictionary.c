/**
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 */

#include <stdbool.h>
#include <stdlib.h>
#include <stdio.h>
#include <ctype.h>
#include <string.h>


#include "dictionary.h"

node* root;
unsigned int dwords = 0;
void freenodes(node* dnode);


/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    node* current = root;
    for (int i = 0; i<=strlen(word); i++) {
        int index = tolower(word[i]) - 'a';
        if ((index < 0 || index > 26) && word[i] != 39) {
            if (current->is_word == true) {
                return true;
                current = root;
            } else {
                return false;
                current = root;
            }
        } else {
            if (current->children[index] != NULL) {
                current = current->children[index];
            } else {
                current = root;
                return false;
            }
        }
    }
    return false;
}

/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char* dictionary)
{

    // open dictionary
    FILE* dictp = fopen(dictionary, "r");
    if (dictp == NULL)
    {
        printf("Could not open %s.\n", dictionary);
        unload();
        return 1;
    }
    
    // initialize required variables
    root = malloc(sizeof(node));
    node* current = root;


    // For each character iterate through the trie
    for (int c = fgetc(dictp); c != EOF; c = fgetc(dictp))
    {
        int charindex = tolower(c) - 'a';
        // if char index returns end of word
        if(charindex == -87) {
            dwords++;
            current->is_word = true;
            current = root;
        } else if(current->children[charindex] == NULL) {
            // if children[i] null, malloc new node and have children[i] point to it
            current->children[charindex] = malloc(sizeof(node));
            current = current->children[charindex];
        } else {
            current = current->children[charindex];
        }
    }
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
    return dwords;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
 
void freenode(node* dnode) {
    if (dnode == NULL) {
        free(dnode);
    } else {
        for(int i = 0; i<27; i++) {
            if(dnode->children[i] != NULL) {
                dnode = dnode->children[i]; 
                freenode(dnode);
            }
        }
    }
}
 
bool unload(void)
{
    freenode(root);
    return true;
}
