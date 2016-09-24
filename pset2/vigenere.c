#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <cs50.h>

int main(int argc, string argv[])
{
    if (argc != 2) {
        printf("Please enter a single string of text only.\n"); 
        return 1;
    }
    
    string key = argv[1];
    int k = strlen(key);
    
    for(int i = 0; i < k; i++) {
        if (isalpha(key[i]) == 0) {
            printf("Please enter a single string of text only.\n"); 
            return 1;
        }
    }
    
    // convert key to lowercase
    for(int i = 0; i< k; i++) {
        key[i] = tolower(key[i]);
    }
    
    string message = GetString();
    int spaces = 0;

    for (int i = 0, n = strlen(message); i < n; i++) {
        // find cumulative number of spaces
        if (message[i] < 65 || (message[i] > 90 && message[i] < 97) || message[i] > 122) {
            spaces++;
        }

        // Find corresponding key
        int j = (i - spaces) % k;
        int shift = key[j] - 97;

        // find ascii value to subtract, so that it can be added later
        int c;
        if(message[i] >= 97) {
            c = 97;
        } else {
            c = 65;
        }
        
        if ((message[i] >= 97 && message[i] <= 122) || (message[i] >= 65 && message[i] <= 90)) {
            printf("%c", ((message[i] - c + shift) % 26) + c);
        } else {
            printf("%c", message[i]);
        }
    }
    printf("\n");
    
}