# Projet_Domestication


### Collaboration Git

Lorsque l'on démarre un travail sur une fonctionnalité :

```bash
# télécharge la dernière version du master
git pull origin master

# créé et bascule sur la branche (dpt -> "dupont")
git checkout -b dpt_my_feature
```

On peut désormais bosser en local.

### mise à jour
Une fois le travail terminé et validé sur la fonctionnalité et que l'on souhaite mettre en ligne :

```bash
# vérifier que l'on est bien sur la branche 
git branch

# ajouter/supprimer les modifs
# git add / git rm

# commit
git commit -m "message de commit"

# passer sur la branche master 
# s'assurer que l'on est bien à jour
git checktout master
git pull origin master

# et mettre à jour la branche master avec le travail
# effectué sur la branche dpt_my_feature
git merge dpt_my_feature

# mettre sur github le master pour partager le travail
git push origin master

# soit on supprime la branche si on a fini
# git branch -d dpt_my_feature
# soit on retourne sur la branche de travail
# git checkout dpt_my_featuree
```

### pour mettre en ligne la branche aussi
```bash
git push origin dpt_my_feature
```

### Code pour afficher la branche courante dans le shell

[https://gist.github.com/rodfigaro/781fac89ec4fb90b4d02](https://gist.github.com/rodfigaro/781fac89ec4fb90b4d02)
