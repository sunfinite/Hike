//TWO WHEELER(.2) clustering algorithm with PROVIDER*ACCEPTOR matrix and cost calculation

#include<stdio.h>
#include<stdlib.h>

#define P 50					//max providers
#define A 50					//max acceptors
#define FUEL 54.0				//cost per unit of fuel

   void input(void);
   void output(void);
   void getmin(int* mrptr, int* mcptr);
   void makehigh(int r, int c);
   void printmatrix(void);
   void getnewdist(void);
   void costcalc(void);

   float pa[P][A];				//distance table(from DB)
   int p,a;							//(from DB)
   int poolp[P],poola[A];		//-1 not pooled; number if pooled [!!DELETE poola[A]!!]
   int pm[P];						//mileage for all the provider vehicles(from DB)
   float distp[P];				//distance travelled by the provider if he was travelling alone(using API)
   float distpa[P];				//total distance travelled by the provider when pooling(using API)
   float cost[P];					//money collected by the provider

   int main()
   {
      int i,j;
      int minr,minc;					//to hold the row and column number of the minimum distance
     
      input();
   	
      i=0;
      j=0;
      while(i<p && j<a)
      {
      //find min dist among the ungrouped using getmin
         getmin(&minr,&minc);
      	//printf("p=%d r=%d\n",minr,minc);
      
      //group the two selected
         poolp[minr]=minc;
         poola[minc]=minr;
      	    
      //use makehigh on the two just grouped so that they arent involved anymore
         makehigh(minr,minc);
      
      //incr i and j to keep a count of the grouped providers and acceptors
         i++;
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
         poolp[i]=-1;									//no provider pooled
         for(j=0;j<a;j++)
         {
         //scanf("%f",&pa[i][j]);
            pa[i][j]=(rand()%20)+1;
         }
      }
   	
      for(j=0;j<a;j++)
         poola[j]=-1;									//no acceptor pooled
   		
   	//printf("Enter the mileage table:\n")
      for(i=0;i<p;i++)
      {
      	//scanf("%d",&pm[i]);
         pm[i]=50-(rand()%13);												//typical 2 wheeler mileage of 38 to 50
      }
   	
   	//printf("Enter the distance travelled by the provider if he was travelling alone:\n");
      for(i=0;i<p;i++)
      {
      	//scanf("%d",&pm[i]);
         distp[i]=(float)(((rand()%100)+1)/10);							//0.1 to 10.0 [this is senseless]
      }		
   }

   void output()
   {
      int i;
      printf("------------RESULT------------\n");
      for(i=0;i<p;i++)
      {
         printf("%d is giving a ride to %d and charging him %f Rs\n",i,poolp[i],cost[i]);
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

   void makehigh(int r, int c)
   {
      int i;
      for(i=0;i<p;i++)
         pa[i][c]=999999;
      for(i=0;i<a;i++)
         pa[r][i]=999999;
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
            distpa[i]=distp[i]+(float)(((rand()%20)+1)/10);				//add 0.1 to 2.0 [this is senseless]
         }
      }
   }
	
   void costcalc()
   {
      int i;
      for(i=0;i<p;i++)
      {
         if(poolp[i]!=(-1))
         {
            cost[i]=(distpa[i]-(distp[i]/2))*((FUEL)/pm[i]);
         }
      }
   }