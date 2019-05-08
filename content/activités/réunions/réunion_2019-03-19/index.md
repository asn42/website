+++
title = "Réunion du 2019-03-19"
description = "Compte rendu de la réunion du 19 mars 2019 de l'"
date = 2019-03-19
+++

# ASN - Compte rendu de la réunion du 19 mars 2019

Nombre de participants : une douzaine dont 2 ou 3 en remote

## 1) Avancement des démarches administratives

Nous avons une assurance (comme demandé par 42 pour pouvoir réserver des salles dans l'établissement).
Nous avons choisi une police d'assurance de la MAE qui coute environ 32€, soit environ 28€ et quelque pour cette année parce qu'elle ne commençait pas en janvier.

Il faudra ajouter la signature du trésorier au compte en banque.

## 2) Serveur

Nous allons essayer de nous faire sponsoriser notre serveur.

- Soit par OVH (en recontactant le type avec qui pk avait parlé)
- Soit par Free (le contact de Charly ne répond pas, mais il y a d'autres pistes)
- Soit par Octopuce (@thifranc se propose de demander)

Nous avons défini une config de base qui pourrait nous aller pour le serveur :

- server dédié
- 4 cœurs
- 8 / 16 Go RAM
- 2 * 500 Go HDD

## 3) Documentation

pk est en train d'écrire de la documentation directement sur le site. Ce n'est pas encore prêt mais il va le mettre en ligne quelques jours après la réunion.
Tout le monde pourra proposer des modifications via Github.

## 4) AdminSys

Il faudra noter les gens intéressés pour participer à l'installation et l'administration du serveur.
On pourra se retrouver en cluster pour bosser dessus ensemble. Ça permettra que tout le monde comprenne à peu près comment ça fonctionne, et on pourra écrire la documentation en même temps.

Il y a aussi quelques choix techniques à faire pour lesquels les décisions seront prises entre les gens qui vont s'en occuper (et éventuellement la maitrise qu'ils ont des technos en question). On a par exemple discuté de l'utilisation de conteneurs ou de VMs.

## 5) Services

Nous allons aussi faire une liste de services qu'on voudrait sur le serveur.
Lorsqu'on a parlé de serveur mail et de LDAP, certains ont revu Roger Skyline 2 passer devant leurs yeux avec un rictus de souffrance :P

- DNS (?)
- Mail (OpenSMTPd/Postfix/Exim, Dovecote (?), DKIM, spamd/SpamAssassin, clamav (?) …)
- LDAP (OpenLDAP) ?
- Le site statique
- Git Web (Gitea/Gitlab…)
- CTF (CTFd + challenges)
- Partage de fichiers (Nextcloud/Owncloud…)
- Agenda (Nextcloud/Radical…)
- Gestion des membres (Galette… ou un truc mieux)
- Gestion d'une base de liens et ressources dans laquelle on peut chercher
- Discussion en direct (Matrix.org/jabber/IRC)
- Discussion pas en direct (Mailman 3/Sympa, Flarum/Discourse)

## 6) Lock picking

pk s'occupe seul des ateliers lock picking.
Il préfèrerait partager cette tache avec d'autres et pouvoir s'engager sur d'autres activités (et que ça ne s'arrête pas quand il ne sera plus là).
Plusieurs membres ont proposé d'alterner. pk peut faire une séance de formation des organisateurs (rien de bien compliqué, il n'y a pas besoin d'arriver à ouvrir une serrure pour expliquer comment on fait :P).

## 7) Pas Sage en Seine

Il y a eu un appel pour organiser un atelier lock picknig à Pas Sage en Seine, comme il y a 2 ans (où nous avions aidé à le faire avec Dylan). pk pense que ça pourrait être intéressant, mais pas tout seul.

Il voudrait aussi avoir un stand pour présenter l'ASN (comme il y a deux ans également) mais… il faudrait qu'il y ait plusieurs personnes. Il n'y a pas d'obligation de rester sur le stand tout le temps mais ça ne sert à rien d'en avoir un si il est vide en permanence.

L'évènement dure 5 jours, mais on peut y être un seul jour, ou deux, trois, quatre, cinq… comme on veut ; il faut juste le dire.

Il y a une salle de conf, la salle en bas avec les stands et des ateliers, et des food truck à côté. C'est assez dans l'esprit hacker / fait main. Ça parle autant de technique que de politique ou de comment faire son pain :D.

## 8) leHACK

pk et Kara s'en occupent et attendent que les choses se débloquent au niveau de l'orga/l'ADM pour lancer les choses.

On aura encore des étudiants bénévoles, mais cette année, on s'occupera de peupler le stand de 42 avec des membres de l'ASN, ou au moins intéressés par la sécu et capables d'en parler.
