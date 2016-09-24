#include <stdio.h>
#include <cs50.h>

int main(void)
{
    int h;

    do {
        printf("height: ");
        h = GetInt();
    } while (h < 0 || h > 23);


    char p = '#';
    // first loop increaments line number
    for(int line=0; line<h; line++) {
        //print each line
        for(int hashes = 1; hashes <= h; hashes++)
        {
           if(hashes >= h-line) {
               printf("%c", p);
           } else {
               printf(" ");
           }
        }
        printf("%c\n", p);
    }
}