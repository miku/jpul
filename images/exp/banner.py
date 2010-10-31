size(195, 100)

fill(0.99, 0.47, 0)
rect(0, 0, 195, 100)

fill(0.98, 0.98, 0.98)
font("Futura", 20)
text("Jobportal", 10, 80)

fill(0.95, 0.95, 0.95)
font("Futura", 10)
text("beta", 100, 80)

nofill()
stroke(1)
for i in range(5):
    oval(random(1, 40), random(2, 100), random(200, 1000), random(200, 1000))