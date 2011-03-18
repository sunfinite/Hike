//home page calculations

#include<stdio.h>

float d;							//distance travelled without pooling of any sort(from DB) 
//all are worst case values
float d2,c2;					//distance travelled and %cost(for provider) while pooling on a 2 wheeler
float d41,c41;					//distance travelled and %cost(for provider) while pooling on a 4 wheeler with 1 receiver
float d42,c42;					//distance travelled and %cost(for provider) while pooling on a 4 wheeler with 2 receivers
float d43,c43;					//distance travelled and %cost(for provider) while pooling on a 4 wheeler with 3 receivers
//can eliminate variable c by using variable d to hold the %cost

void input(void);

void calculate(void);

void output(void);

int main()
{
	input();
	
	calculate();
	
	output();
	
	return 0;
}

void input()
{
	printf("Enter the distance travelled everyday without pooling: ");
	scanf("%f",&d);
}

void calculate()
{
	d2=d+3;											//this is really lame sunny, i donno y u want me to do this
	d41=d+3;											//this is sooo far away from simulating reality, nothing more than fancy
	d42=d+(1.5)+(2.12)+(2.12);					//(1.5)^2 + (1.5)^2 = (2.12)^2
	d43=d+(1.5)+(2.12)+(2.12)+(2.12);
	c2=d2/(2*d)*100;
	c41=d41/(2*d)*100;
	c42=d42/(3*d)*100;
	c43=d43/(4*d)*100;
}

void output()
{
	printf("Expenditures:\n\n");
	printf("Not pooling: 100%% fuel cost\n\n");
	printf("Pooling on a 2 wheeler: %.2f%\n\n",c2);
	printf("Pooling on a 4 wheeler:\n");
	printf("\t\tWith 1 co-rider: %.2f%\n",c41);
	printf("\t\tWith 2 co-riders: %.2f%\n",c42);
	printf("\t\tWith 3 co-riders: %.2f%\n",c43);
}