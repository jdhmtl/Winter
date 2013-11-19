Winter Running Contest for RWOL

I put this together quickly in winter 2012 to host the Winter Running Contest. If you're unfamiliar with it, the rules are essentially thus:
- Players are split into teams (historically three) based primarily on weather
- Players compete against their teammates, not against other teams
- Runs are scored based on 'feels like' temperatures -- the colder it is, the more points you earn -- with bonuses for precipitation
- It's a *winter* running contest, so the temperature must be 50F or below to score points
- A time multiplier is then applied to the score; 0.5x per half hour (eg. runs of up to 30 minutes earn only half points, runs up to 90 minutes earn 1.5x, and so forth)
- Scores are tallied on a weekly basis as well as overall scores for the duration of the contest
- Weekly awards recognize those with the highest scoring individual runs, those running in the coldest temperatures, and those running the longest
- I shouldn't need to say this, but you need to run OUTSIDE for your run to count

The app itself is based on CakePHP (2.3.9 at time of writing), which is distributed separately. As written, drop this repo into /public_html and CakePHP into /framework, create your database using Config/Schema/winter.sql, edit Config/database.php with your DB credentials, and it *should* just work. The three teams from 2012 are included, as is one admin user (admin:password -- please change that).

I am no longer active in the RWOL/RA communities, so I can't promise I'll reply to questions there. Additionally, you're probably better off forking the code than submitting pull requests if you're planning on making changes. At present, I have no plans to maintain this project. I am simply releasing it as is for anyone interested in hosting the game.