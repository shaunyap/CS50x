#include <stdio.h>
#include <string.h>
#include <cs50.h>

int main(int argc, string argv[])
{
    if (argc != 2) {
        printf("Please enter a single number\n"); 
        return 1;
    }
    
    int k = atoi(argv[1])%26;
    
    string message = GetString();
    
    for (int i = 0, n = strlen(message); i < n; i++) {
        int c;
        
        if(message[i] >= 97) {
            c = 97;
        } else {
            c = 65;
        }
        
        if ((message[i] >= 97 && message[i] <= 122) || (message[i] >= 65 && message[i] <= 90)) {
            printf("%c", ((message[i] - c + k) % 26) + c);
        } else {
            printf("%c", message[i]);
        }
    }
    printf("\n");
    
}