//FOUR WHEELER(.1) clustering algorithm with PROVIDER*ACCEPTOR matrix

#include<stdio.h>
#include<stdlib.h>

#define P 50					//max providers
#define A 50					//max acceptors
#define FUEL 54.0				//cost per unit of fuel

   void input(void);
   void output(void);
   void getmin(int* mrptr, int* mcptr);
   int makehigh(int r, int c);
   void printmatrix(void);
	void getnewdist(void);
	void costcalc(void);

   float pa[P][A];					//distance table(from DB)
   int p,a;								//(from DB)
   int poola[A];						//-1 not pooled; number if pooled [!!poolp[P] NOT USED!!]
   int poolp[P];						//-1 - not pooled; 1 - pooled
   int poolpmax[P];					//max capacity of the vehicle, not counting the provider(from DB)
	int Cpoolpmax[P];					//copy of poolpmax
   int pm[P];							//mileage for all the provider vehicles(from DB)
   float distp[P];					//distance travelled by the provider if he was travelling alone(using API)
   float distpa[P];					//total distance travelled by the provider when pooling(using API)
   float cost[P];						//money collected by the provider
	
   int main()
   {
      int i,j,x;
      int minr,minc;					  //to hold the row and column number of the minimum distance
     
      input();
   
      i=0;
      j=0;
      while(i<p && j<a)
      {
      
      //find min dist among the ungrouped using getmin
         getmin(&minr,&minc);
      	
      //group the two selected
         poola[minc]=minr;
         poolpmax[minr]--;
         poolp[minr]=1;					//mark as pooled for costcalc
      	
      //use makehigh on the acceptor to exclude him, and also on provider if he doesnt have any room
         x=makehigh(minr,minc);
      	
      //incr i and j to keep a count of the grouped providers and acceptors
         i=i+x;
         j++;
      	
      //print the present state of matrix to verify
         //printmatrix();
      }
   
   	//fill the distpa table for the pooling just concluded
      getnewdist();
   	
   	//calculate the cost
      costcalc();
   	
      output();
   	
      return 0;
   }
	
   void input()
   {
      int i,j;
   	
      printf("Enter the number of providers: ");
      scanf("%d",&p);
      printf("Enter the number of acceptors: ");
      scanf("%d",&a);
   
      //printf("Enter the P*A distance table:\n");
      for(i=0;i<p;i++)
      {
			poolp[i]=(-1);
         for(j=0;j<a;j++)
         {
            //scanf("%f",&pa[i][j]);
            pa[i][j]=(rand()%20)+1;
         }
      }
      for(j=0;j<a;j++)													//nobody is pooled
         poola[j]=(-1);
   	//printf("Enter the max capacity table:\n");
      for(i=0;i<p;i++)
      {
      	//scanf("%d",&poolpmax[i]);
         poolpmax[i]=(rand()%3)+1;									//not counting the provider
			Cpoolpmax[i]=poolpmax[i];									//poolpmax will be destroyed, so keep a copy
      }
   	//printf("Enter the mileage table:\n")
      for(i=0;i<p;i++)
      {
      	//scanf("%d",&pm[i]);
         pm[i]=16-(rand()%6);												//typical 4 wheeler mileage of 11 to 16
      }
   	
   	//printf("Enter the distance travelled by the provider if he was travelling alone:\n");
      for(i=0;i<p;i++)
      {
      	//scanf("%d",&pm[i]);
         distp[i]=(float)(((rand()%100)+1)/10);							//0.1 to 10.0 [this is senseless]
			printf("%f\n",distp[i]);
      }		
   
   }

   void output()
   {
      int i;
      printf("------------RESULT------------\n");
      for(i=0;i<a;i++)
      {
         printf("%d is taking a ride from %d and paying him %f Rs\n",i,poola[i],cost[poola[i]]);
      }
   }
	
   void getmin(int* mrptr, int* mcptr)
   {
      int i,j,flag=1;
      float min;
      for(i=0;i<p;i++)
      {
         for(j=0;j<a;j++)
         {
            if(flag)						//to find the first valid min distance
            {
               if(pa[i][j]!=999999)
               {
                  min=pa[i][j];
                  *mrptr=i;
                  *mcptr=j;
                  flag=0;
               }
            }
            else							//to better the present min distance
            {
               if(pa[i][j]<min)
               {
                  min=pa[i][j];
                  *mrptr=i;
                  *mcptr=j;
               }
            }
         }
      }
   }

   int makehigh(int r, int c)
   {
      int i;
      for(i=0;i<p;i++)
         pa[i][c]=999999;
      if(poolpmax[r]==0)									//makehigh only if there is no room for another person
      {
         for(i=0;i<a;i++)
            pa[r][i]=999999;
         return 1;											//mark that a provider is full
      }
      return 0;												//mark that the provider is not yet full
   }

   void printmatrix()
   {
      int i,j;
      printf("Intermediate state of the distance table:\n");
      for(i=0;i<p;i++)
      {
         for(j=0;j<a;j++)
         {
            printf("%15.1f",pa[i][j]);
         }
         printf("\n");
      }
   }
	
   void getnewdist()
   {
      int i;
   	//printf("Enter the total distance travelled by the provider when pooling:\n");
      for(i=0;i<p;i++)
      {
         if(poolp[i]!=(-1))
         {
         	//scanf("%d",&pm[i]);
            distpa[i]=distp[i]+(float)((((rand()%20)+1)/10)*Cpoolpmax[i]);				//add 0.1 to 2.0 [this is senseless]
				printf("%f\n",distpa[i]);
         }
      }
   }
	
   void costcalc()
   {
      int i;
      for(i=0;i<p;i++)
      {
         if(poolp[i]!=(-1))														//if provider is pooled
         {
            cost[i]=((distpa[i]-(distp[i]/(Cpoolpmax[i]+1)))*((FUEL)/pm[i]))/Cpoolpmax[i];
				printf("%d %f %f %d %d %f\n",i,distp[i],distpa[i],Cpoolpmax[i],pm[i],FUEL/pm[i]);
         }
      }
   }
	
	
	//can have a function to link all the acceptors to the providers using dynamic allocation 
	//for the number of acceptors linked to the provider
	//this will be helpful during the distance retrival from GMaps API