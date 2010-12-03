colors = ximport("colors")
size(539, 82)

path = rect(0, 0, 539, 82)
colors.gradientfill(path, colors.hex('#FF7b04'), colors.white(), type="linear", 
             dx=0, dy=0, spread=5.0, angle=90, alpha=1)

fill(0.3)
font("Futura", 20)
text("Jobportal", 200, 50)

fill(0.5)
font("Futura", 10)
text("Beta", 290, 50)

#path = rect(0, 26, 539, 54)
#c = colors.hex('#FF7b04')
#c.alpha = 0.8
#colors.gradientfill(path, c, colors.white(), type="linear", 
#             dx=0, dy=0, spread=30.0, angle=90, alpha=1.0)


# rect(0, 54, 539, 82)
#colors.gradientfill(path, colors.hex('#FF7b04'), colors.white(), type="linear", 
#             dx=0, dy=0, spread=3.0, angle=90, alpha=1)