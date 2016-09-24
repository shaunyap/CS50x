/**
 * resize.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Copies a BMP piece by piece, just because.
 */
       
#include <stdio.h>
#include <stdlib.h>

#include "bmp.h"

int main(int argc, char* argv[])
{
    // ensure proper usage
    if (argc != 4)
    {
        printf("Usage: ./copy factor infile outfile\n");
        return 1;
    }

    // remember resize factor
    int n = atoi(argv[1]);
    
    if (n < 1 || n > 100)
    {
        printf("please enter a n between 1 and 100\n");
        return 5;
    }

    // remember filenames
    char* infile = argv[2];
    char* outfile = argv[3];

    // open input file 
    FILE* inptr = fopen(infile, "r");
    if (inptr == NULL)
    {
        printf("Could not open %s.\n", infile);
        return 2;
    }

    // open output file
    FILE* outptr = fopen(outfile, "w");
    if (outptr == NULL)
    {
        fclose(inptr);
        fprintf(stderr, "Could not create %s.\n", outfile);
        return 3;
    }

    // read infile's BITMAPFILEHEADER
    BITMAPFILEHEADER bfin, bfout;
    fread(&bfin, sizeof(BITMAPFILEHEADER), 1, inptr);
    bfout = bfin;
    
    // read infile's BITMAPINFOHEADER
    BITMAPINFOHEADER biin, biout;
    fread(&biin, sizeof(BITMAPINFOHEADER), 1, inptr);
    
    biout = biin;

    // ensure infile is (likely) a 24-bit uncompressed BMP 4.0
    if (bfin.bfType != 0x4d42 || bfin.bfOffBits != 54 || biin.biSize != 40 || 
        biin.biBitCount != 24 || biin.biCompression != 0)
    {
        fclose(outptr);
        fclose(inptr);
        fprintf(stderr, "Unsupported file format.\n");
        return 4;
    }

    biout.biHeight  = biin.biHeight * n;
    biout.biWidth   = biin.biWidth * n;
 
    int padding =  (4 - (biin.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;
    int paddingout = (4 - (biout.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;
    
    biout.biSizeImage = (biout.biWidth * sizeof(RGBTRIPLE) + paddingout) * abs(biout.biHeight);
    bfout.bfSize = 54 + biout.biSizeImage;

    // write outfile's BITMAPFILEHEADER

    fwrite(&bfout, sizeof(BITMAPFILEHEADER), 1, outptr);

    // write outfile's BITMAPINFOHEADER
    fwrite(&biout, sizeof(BITMAPINFOHEADER), 1, outptr);


    // iterate over infile's scanlines
    for (int i = 0, biHeight = abs(biin.biHeight); i < biHeight; i++)
    {

        // repeat the scanline
        for (int l = 0; l < n; l++) {

            // iterate over pixels in scanline
            for (int j = 0; j < biin.biWidth; j++)
            {
                // temporary storage
                RGBTRIPLE triple;
    
                // read RGB triple from infile
                fread(&triple, sizeof(RGBTRIPLE), 1, inptr);
    
                // write RGB triple to outfile
                for (int k = 0; k < n; k++) {
                    fwrite(&triple, sizeof(RGBTRIPLE), 1, outptr);
                }
            }
            
                // skip over padding, if any
                fseek(inptr, padding, SEEK_CUR);
        
                // then add it back (to demonstrate how)
                for (int k = 0; k < paddingout; k++)
                {
                    fputc(0x00, outptr);
                }
                
                if (l < n - 1)
                 fseek(inptr, -(biin.biWidth * sizeof(RGBTRIPLE) + padding), SEEK_CUR);
    
        }
    }

    // close infile
    fclose(inptr);

    // close outfile
    fclose(outptr);

    // that's all folks
    return 0;
}
