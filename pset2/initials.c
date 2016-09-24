#include <stdio.h>
#include <string.h>
#include <cs50.h>

int main(void)
{
    string name = GetString();
    int i = 0, N = strlen(name);
    do {
        if(i == 0 || (int) name[i-1] == 32) {
            if (name[i] >= 'a' && name[i] <= 'z') {
                printf("%c", name[i] - ('a'- 'A'));
            } else {
                printf("%c", name[i]);
            }
        }
        i++;
    } while (i < N);
    
    printf("\n");
}