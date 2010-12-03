colors = ximport("colors")
size(539, 82)

def write(x, y):
    fill(0.3)
    font("Futura", 22)
    text("Jobportal", x, y)

    fill(0.5)
    font("Futura", 10)
    text("Beta", x + 96, y - 11)

white = colors.white()
orange = colors.hex('#FF7b04')
dimmed = colors.hex('#FFB260')

g = colors.gradient(white, orange, steps=270)
for i in range(len(g)):
    fill(g[i])
    rect(i * 2, 0, (i + 1) * 2, 82)

g = colors.gradient(white, dimmed, steps=270)
for i in range(len(g)):
    fill(g[i])
    rect(i * 2, 26, (i + 1) * 2, 28)

write(200, 49)

fill(1)
oval(300, 10, 10, 10, draw=True)