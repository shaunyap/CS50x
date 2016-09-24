#include <stdio.h>
#include <math.h>
#include <cs50.h>

int main(void)
{
    float change;
    float cents;

    do {
        printf("O hai! How much change is owed?\n");
        change = GetFloat();
        cents = round(change * 100);
    } while (change < 0);


    int c = 0;
    while (cents >= 25) {
            cents = round(cents - 25);
            c++ ;
        }
        
    while (cents >= 10) {
            cents = round(cents - 10);
            c++ ;
        }

    while (cents >= 5) {
            cents = round(cents - 5);
            c++ ;
        }

    while (cents >= 1) {
            cents = round(cents - 1);
            c++ ;
        }
        
    printf("%i\n", c);
}