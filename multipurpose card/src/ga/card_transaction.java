/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ga;

import java.util.Random;
import java.util.*;

/**
 *
 * @author Nirvana
 */
public class GA {
    String[] popString;
    int[] popDec;
    int[] popFit;
    int bestFitVal;
    public GA(String[] pString,int[] pInt,int[] pFit ){
    popString=pString;
    popDec=pInt;
    popFit=pFit;
    }
    public void calBestfit(){
    Random rand=new Random();
    boolean flag=true;
    for(int b=0;b<popFit.length;b++){
        if(popFit[b]>bestFitVal){
            bestFitVal=popFit[b];
        }
    }
    int worNum=2; //number of worst positions to be eliminated
    int bestNum=worNum; //Best possible values
    int shift=popFit.length-1;
    while(worNum>0){ //elimating worst positions
        int worstFit=popFit[0];
         int worPos=-1;
    for(int w=0;w<popFit.length;w++){
        
        if(popFit[w]<=worstFit){
        worstFit=popFit[w]; //finding worst fitness value
        worPos=w; //saving the worst position index
        //System.out.println("WORST POS "+w+" FIT VAL "+worstFit);
        }
    }
    popString[worPos]="";
    popDec[worPos]=0;
    popFit[worPos]=0;
    for(int l=worPos;l<popFit.length-1;l++){
    popString[l]=popString[l+1];
    popDec[l]=popDec[l+1];
    popFit[l]=popFit[l+1];
    }
    popString[shift]="";
    popDec[shift]=0;
    popFit[shift]=0;
    shift--;
    worNum--;
    }
    System.out.println("AFTER WORST ELIMATION");
     for(int j=0;j<popFit.length;j++){
       System.out.print("L"+j+"  "+popString[j]+"  "+popDec[j]+"  "+popFit[j]);
       System.out.println();
       }
     //crossover from random best strings 
     System.out.println("RANDOM BEST "+bestNum);
     int pairN=bestNum;
     String[] newStrings=new String[2*pairN]; //storing the crossovered strings 
     String p1,p2="";
     int stItr=0; //iterating new string array
     for(int p=0;p<pairN;p++){
     int sp1=rand.nextInt((popString.length-bestNum)); //choosing string randomly for crossing
     p1=popString[sp1];
     int sp2=rand.nextInt((popString.length-bestNum));
     if(sp1==sp2){
         System.out.println("SAME!");
         flag=false;
         break;
     }
     else{
     p2=popString[sp2];
     }
     System.out.println("P1 and P2 :"+p1+" "+p2);
     int pos=rand.nextInt(3); //starting position
     System.out.println(pos+" POS");
     int nBit=rand.nextInt(4-pos); //no of bits that will be crossed
     System.out.println(nBit+" No. of bits for crossing");
     if(nBit==0){
     newStrings[stItr]=p1;
     stItr++;
     newStrings[stItr]=p2;
     stItr++;
     }
     else{
     char[] p1c=p1.toCharArray();
        char[] p2c=p2.toCharArray();
     while(nBit>0){
         //System.out.println("TIMES HAHAHAHA");
        char np1=p1c[pos];
        p1c[pos]=p2c[pos];
        p2c[pos]=np1;
        nBit--;
     }
        newStrings[stItr]=String.valueOf(p1c);
        stItr++;
        //System.out.println("STITR VAL: "+stItr);
        newStrings[stItr]=String.valueOf(p2c);
        stItr++;
     
     }
     }
     if(flag!=false){
     for(int st=0;st<newStrings.length;st++){
     System.out.println("NEW STRINGS :"+newStrings[st]);
     }
     //Mutation: Selecting two random strings from crossovered ones
     int mr=2; //defined the range for understanding, will select 2 from 4 strings 
     int mp=rand.nextInt(4); //mp th position of bit will be flipped 
     String[] mutateVal=new String[mr];
     System.out.println("MP "+mp);
     String[] mutS=new String[mr];
     int mut=0;
     for(int m=0;m<mr;m++){  //mutating from the range, randomly picking mr number of strings
         int c=rand.nextInt(2*pairN);
         if(m!=0){
         while(mut==c){
         System.out.println("Same string please re do");
         c=rand.nextInt(2*pairN);
         }
         mut=c;
         }
         else{
         mut=c;
         }
         System.out.println("NEW STRINGS MUT: "+newStrings[mut]);
         char[] mc=newStrings[mut].toCharArray();
         if(newStrings[mut].charAt(mp)=='1'){
         mc[mp]='0';
         //System.out.println("I AM ONE");
         }
         else{
         mc[mp]='1';
         //System.out.println("I AM ZERO");
         }
         mutateVal[m]=String.copyValueOf(mc);
         System.out.println(mutateVal[m]);
     }
     //finding fitness and replacing worst values in first generation 
     int muta=0;
     for(int f=5;f>=4;f--){
         String s=mutateVal[muta];
         int dec=giveInt(s);
     popDec[f]=dec;
     popString[f]=mutateVal[muta];
     popFit[f]=(15*popDec[f])-((popDec[f])*(popDec[f]));
     //System.out.println(popDec[f]+"  "+popString[f]+"  "+popFit[f]);
     }
     }
     System.out.println("Generation 1");
     for(int j=0;j<popFit.length;j++){
       System.out.print("L"+j+"  "+popString[j]+"  "+popDec[j]+"  "+popFit[j]);
       System.out.println();
       }
     //Best fitness value 
     for(int b=0;b<popFit.length;b++){
        if(popFit[b]>bestFitVal){
            bestFitVal=popFit[b];
        }
    }
     System.out.println("BEST FITNESS VALUE IS "+bestFitVal);
    }
    public static int giveInt(String x){
       int result = 0;
       if(x.equals("0000")){
          result = 0;
       }
       else if(x.equals("0001")){
           result = 1;
       }
       else if(x.equals("0010")){
           result = 2;
       }
       else if(x.equals("0011")){
           result = 3;
       }
       else if(x.equals("0100")){
           result = 4;
       }
       else if(x.equals("0101")){
           result = 5;
       }
       else if(x.equals("0110")){
           result = 6;
       }
       else if(x.equals("0111")){
           result = 7;
       }
       else if(x.equals("1000")){
           result = 8;
       }
       else if(x.equals("1001")){
           result = 9;
       }
       else if(x.equals("1010")){
           result = 10;
       }
       else if(x.equals("1011")){
           result = 11;
       }
       else if(x.equals("1100")){
           result = 12;
       }
       else if(x.equals("1101")){
           result = 13;
       }
       else if(x.equals("1110")){
           result = 14;
       }
       else if(x.equals("1111")){
           result = 15;
       }
       return result;
   }
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
         int pop=6;
       String[] popString={"1100","0100","0001","1110","0111","1001"};
       int[] decodeInt={12,4,1,14,7,9};
       int[] fitness=new int[pop];
       for(int i=0;i<pop;i++){
           int x=decodeInt[i];
       fitness[i]=(int)((15*x)-(x*x));
       }
       System.out.println("GENERATION 0");
       for(int j=0;j<pop;j++){
       System.out.print("L"+j+"  "+popString[j]+"  "+decodeInt[j]+"  "+fitness[j]);
       System.out.println();
       }
       GA g=new GA(popString,decodeInt,fitness);
       g.calBestfit();
       
    }
    
}
