+++
title = "Débuter en sécurité informatique"
description = "Des pistes pour bien commencer dans la sécurité informatique avec l'"
aliases = ["documentation/sécurité/debuter"]
[extra]
translations = [
    "activities/discussions/documentation/security/beginning/index.en.md"
]
+++

## Par quoi commencer ?

### S'informer

Discutez avec des gens qui s'intéressent à la sécurité
([nous](@/contact/index.fr.md), par exemple :D). Posez des questions, mais ne
croyez pas tout ce qu'on vous dit.

Vous pouvez aller à des meetings (discussions autours d'un verre). Ceux de RTFM
ont lieu à Paris ([annoncés sur Twitter](https://twitter.com/sigsegv_event)).
Ceux de HZV sont à l'Electrolab de Nanterre (annoncés [sur leur
site](https://hackerzvoice.net/) et/ou [sur
Twitter](https://twitter.com/asso_hzv)) les premiers samedis du mois, et des
présentations y sont données de temps en temps.

Allez voir des conférences, et regardez en sur Internet. Lisez des blogs, des
journaux spécialisés, des zines…

Vous pouvez aussi aller à des évènements autours de la sécurité, comme
[leHack](@/activities/volunteering/le-hack/_index.md) (pour lequel on gère le
bénévolat d'étudiants de 42) ou l'[ESE](https://ese.esiea.fr/) vers Paris,
[GreHack](https://grehack.fr/), le [Sthack](https://www.sthack.fr/),
[Ins'Hack](https://inshack.insecurity-insa.fr/) et autres aux quatre coins de
la France, ou si vous pouvez vous déplacer en Europe, les [Sécurity
BSides](https://www.securitybsides.com/w/page/12194156/FrontPage#Europe) ou
[Brucon](https://www.brucon.org/) par exemple.
Évidemment, vous avez tout intérêt à profiter des évènements qui se passent à
42.

### Capture the flag (CTF) / Wargame

Un bon point d'entrée peut être de faire des CTFs. Ce sont des jeux basés sur
des challenges de sécurité, parfois avec un scénario, où il faut trouver des
flags (des chaînes de caractères spécifiques) pour gagner des points.
Synacktiv nous avait envoyé un ancien étudiant et un stagiaire de 42 pour en
parler : [Comment qu'est ce qu'on flag ? Introduction aux
CTF](@/activities/conferences/introduction-ctf/index.fr.md).

Il existe [des sites pour
s'entrainer](@/activities/discussions/documentation/security/ressources/index.fr.md#challenges-et-entrainement)
où les challenges restent disponibles assez longtemps, mais il y a aussi des
CTFs ponctuels que l'on peut généralement trouver sur
[CTFtime.org](https://ctftime.org/).

Si vous avez un compte étudiant de 42, vous pouvez essayer [les 5 challenges
que nous avions proposé en 2017](https://wargame2017.sansnom.org/).
Nous devrions en proposer d'autres bientôt.

Nous essayons de nous retrouver plus ou moins régulièrement dans les clusters
de 42 pour se mettre sur des challenges, puis échanger des write ups (les
solutions rédigées).

Lors des challenges ponctuels, il n'est pas rare qu'après une étape de
qualification en ligne, quelques équipes s'affrontent entre elles à un endroit
physique, en devant défendre leur système et attaquer celui des autres.

Lorsqu'on commence à maîtriser certains outils et techniques, il peut être
intéressant de se frotter aux challenges dits « réalistes », voire aux bug
bounties.

## Aller plus loin

### Bug bounties

Les bug bounties ne sont, contrairement aux challenges des CTFs et wargames,
pas des épreuves préparées spécialement. Il n'y a pas un objectif précis mais
uniquement un périmètre défini et quelques règles (souvent pas de DOS ou autres
pratiques pouvant interrompre le service). Plus les bugs trouvés sont simples
et critiques, plus ils rapportent de points (et d'argent).

Il existe quelques plateformes de bug bounty publique comme
[YesWeHack](https://www.yeswehack.com/fr/bug-bounty-hunter.html) ou
[HackerOne](https://www.hackerone.com/start-hacking).
Les bug bounties publiques permettent de voir comment ça fonctionne et de
pratiquer.

Pour pouvoir participer aux bug bounties privés (où il reste plus de bugs
"originaux" à trouver et donc de point et d'argent), ça se passe en général par
recommandation/cooptation : il faut déjà s'être fait remarqué pour y être
invité. L'exception, pour nous, ce sont les deux ou trois bug bounties du
HackPéro Parisien annuel qui s'est jusqu'ici toujours passé à 42 et était donc
ouvert aux étudiants.
