print("Welcome to Fithub BMI calacualtor 🏋️")
weight=float(input("Enter your weight in kilograms: "))
height=float(input("Enter your height in meters: "))
bmi=weight/ (height**2)
print(f"Your BMI is: {bmi:.2f}") #here 2f means --> format the number as a decimal with 2 places

if bmi< 18.5:
    print("Category: Underweight")
elif 18.5<= bmi < 24.9:
    print("Category: Normal weight")
elif 25<= bmi<29.9:
    print("Category: Overweight")
else:
    print("Category: Obese")