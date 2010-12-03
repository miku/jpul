colors = ximport("colors")

sand = colors.theme()
sand.add_range(colors.soft, colors.white(), weight=0.5)
sand.add_range(colors.dark, colors.goldenrod(), weight=0.25)
sand.add_range(colors.warm, colors.brown(), weight=0.25)
# sand.swatch(2, 2, w=7, h=7, padding=1)

size(550, 275)
background( sand() )
colors.shadow(alpha=0.1, dx=-40, blur=10)

for clr in sand:
    fill(clr)
    translate(10)
    scale(0.96)
    skew(10)
    rect(0, -40, 400, 400)
    

t = colors.theme("love", guess=True)
background( colors.list(t).darkest)
t.swarm(50, 50)