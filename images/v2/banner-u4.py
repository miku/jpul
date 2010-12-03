colors = ximport("colors")
size(1, 82)

white = colors.white()
orange = colors.hex('#FF7b04')
dimmed = colors.hex('#FFB260')

g = colors.gradient(white, orange, steps=270)
fill(g[-1])
rect(0, 0, 1, 82)

g = colors.gradient(white, dimmed, steps=270)
fill(g[-1])
rect(0, 26, 1, 28)


