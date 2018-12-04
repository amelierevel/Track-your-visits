<?php
//insertion du fichier path et de la page header
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php';
?>
<div class="lime lighten-3" id="indexSection">
    <div class="center-align " id="visitorSection">
        <h2>Visiteur</h2>
        <p>
            Vous partez en vacances et recherchez des lieux à visiter ou des activités à faire, seul ou en famille, à proximité de votre lieux de vancances.
            Vous souhaitez simplement redécouvrir la région où vous habitez. Le site <span class="boldText">Track your visits</span> vous permet de consulter la liste des 
            lieux et activités à visiter dans la région que vous souhaitez. Vous pouvez, rechercher un lieux qui vous intéresse en particulier, faire votre recherche 
            selon le type de visites que vous souhaitez faire. Vous aurez ainsi accès à toutes les informations utiles à savoir concernant chaque lieux (adresse, 
            contact, horaires, tarifs...). En vous inscrivant sur le site <span class="boldText">Track your visits</span> en tant que visiteur vous pourrez enregistrer les lieux qui vous 
            intéresse afin d'avoir un accès rapide aux informations de ce lieux. Une fois votre visite effectuée vous pouvez enregistrer le lieux dans votre section 
            "Mes visites" vous aurez ainsi une trace de toutes les visites que vous avez pu faire.
        </p>
        <a href="Inscription-visiteur" class="btn waves-effect waves-light lime darken-3 boldText" title="Lien vers la page d'inscription d'un visiteur">Cliquer ici pour créer un compte Visiteur</a>
    </div>
    <div class="center-align" id="contributorSection">
        <h2>Contributeur</h2>
        <p>
           Vous êtes un professionnel, vous cherchez à faire connaître votre site ou simplement gagner en visibilité pour attirer plus de visiteurs. Vous pouvez ajouter 
           votre site sur <span class="boldText">Track your visit</span> en renseignant toutes ses informations pour permettre aux visiteurs de découvrir votre lieu.
           Vous êtes un visiteur engagé, vous souhaitez ajouter de nouveaux lieux qui ne sont pas encore référencés sur <span class="boldText">Track your visits</span>.
           Vous avez remarqué que les informations d'un lieux n'étaient plus à jour et vous voulez contribuer en les mettant à jour pour que tous les utilisateurs aient accès 
           à des informations correctes; alors devenez un contributeur. Les contributeurs ont accès aux mêmes fonctionnalités que les visiteurs mais ils peuvent en plus, ajouter 
           de nouveaux lieux et mettre à jour les informations des lieux déjà présents sur le site.
        </p>
        <a href="Inscription-visiteur" class="btn waves-effect waves-light lime darken-3 boldText" title="Lien vers la page d'inscription d'un visiteur">Cliquer ici pour créer un compte Visiteur</a>
    </div>
    <div class="left-align" id="placesSection">
        <h2 class="center-align">Les lieux à visiter</h2>
        <h3 class="underlineSize">Musées</h3>
        <p>
            Dans la catégorie <span class="boldText">Musées</span> on trouve les musées d'art, d'histoire, de sciences et toutes les spécialités, 
            plus les curiosités locales et les archives.
        </p>
        <h3 class="underlineSize">Sites et Monuments</h3>
        <p>
            Dans la catégorie <span class="boldText">Sites et monuments</span> on trouve tous les points d'intérêts notoires parmi lesquels, 
            les monuments, les statues, les promenades, les bâtiments possédant un intérêt architectural certain, les édifices religieux, les ruines antiques et les 
            sites historiques.
        </p>
        <h3 class="underlineSize">Parcs d'attractions</h3>
        <p>
            Dans la catégorie <span class="boldText">Parcs d'attractions</span> on trouve les parcs d'attractions, les grands parcs aquatiques et les parcs à thème 
            ouverts toute l'année.
        </p>
        <h3 class="underlineSize">Jeux et Divertissements</h3>
        <p>
            Dans la catégorie <span class="boldText">Jeux et Divertissements</span> on trouve tout un éventail d'activités comme le kart, le bowling, le cinéma, 
            le minigolf, l'escalade en salle, les piscines publiques, les complexes de jeux pour les enfants, les jeux d'évasion grandeur nature ou les stands de tir.
        </p>
        <h3 class="underlineSize">Parcs animaliers et Zoos</h3>
        <p>
            La catégorie <span class="boldText">Parcs animaliers et Zoos</span> comprend tous les endroits où les gens peuvent voir ou interagir avec des animaux. 
            On y trouve par exemple, ormis les parcs animaliers et zoos à proprement parler, les fermes éducatives, les centres de réhabilitation des animaux ou les 
            aquariums.
        </p>
    </div>
</div>
<?php
//insertion du footer
include_once path::getRootPath() . 'footer.php';
?>