#include <stdio.h>
#include <cs50.h>

int main(void)
{
    printf("minutes: ");
    int m = GetInt();
    
    //convert minutes to bottles
    int b = m * 12;

    printf("bottles: %i\n", b);
}