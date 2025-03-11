from manim import *
config.background_opacity = 1

class DiesingSmoothMorph(Scene):
    def construct(self):
        word = "DIESING"
        letters = [Text(char, font_size=120).set_color(RED) for char in word]

        current_letter = letters[0]
        self.play(GrowFromCenter(current_letter))
        self.wait(0.3)

        for next_letter in letters[1:]:
            next_letter.match_style(current_letter)
            next_letter.move_to(current_letter)

            self.play(
                Transform(current_letter, next_letter, rate_func=smooth),
                run_time=0.7
            )
            self.wait(0.3)

        self.wait(1)
