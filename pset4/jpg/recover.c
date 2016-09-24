/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Recovers JPEGs from a forensic image.
 */
 
#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>

int main(void)
{
    // Open memory card file
        FILE* card = fopen("card.raw", "r");
        if (card == NULL)
        {
            printf("Could not open file.\n");
            return 1;
        }
    
    uint8_t buffer[512];
    int iCount = 0;
    FILE* temp = NULL; 

    while (!feof(card))
    {
       
        // check for jpg signature
        if (buffer[0] == 0xff && buffer[1] == 0xd8 && buffer[2] == 0xff && (buffer[3] == 0xe0 || buffer[3] == 0xe1))
        {
            // if already exist, then close file
            if (temp != NULL)
            {
                fclose(temp);
            }
            
            // create a new file with the next number in line
            char iName[8];
            sprintf(iName, "%03d.jpg", iCount);
            
            // put the file in temp variable
            temp = fopen(iName, "w");
            
            // bump the counter up
            iCount++;
            
            // new file with buffer
            fwrite(buffer, sizeof(buffer), 1, temp);
        }
        
        // if it doesn't have the jpg signature, it is the next bytes of the picture that need to be written
        else if (iCount > 0)
        {
            fwrite(buffer, sizeof(buffer), 1, temp);
        }
      
        fread(buffer, sizeof(buffer), 1, card);
        
    }
    
    
    // close infile
    fclose(card);
    
}
