<?php include 'header.php'; ?>
<div class="container">
    <h2 class="center-align">Inscription d'un nouvel utilisateur</h2>
    <div class="row">
        <form action="#" method="POST" class="col s12">
            <!--Champs nom et prénom-->
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="lastname" id="lastname" value="<?= /* garde en mémoire la saisie dans le champ */ isset($lastname) ? $lastname : '' ?>" class="validate" required />
                    <label for="lastname">Nom</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input  type="text" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : '' ?>" class="validate" required />
                    <label for="firstname">Prénom</label>
                </div>
            </div>
            <!--Champs nom et type d'utilisateur-->
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">assignment_ind</i>
                    <input  type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>" class="validate" required />
                    <label for="username">Nom d'utilisateur</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">assignment_ind</i>
                    <select name="userType" required>
                        <option value="0" disabled selected>Type d'utilisateur</option>
                        <option value="1" class="validate">Utilisateur classique</option>
                        <option value="2" class="validate">Contributeur (professionnel ou particulier)</option>
                    </select>
                    <label for="userType">Veuillez sélectionner un type d'utilisateur : </label>
                </div>
            </div>
            <!--Champs date de naissance et email-->
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">date_range</i>
                    <input type="date" name="birthDate" id="birthDate" placeholder="jj/mm/aaaa" value="<?= isset($birthDate) ? $birthDate : '' ?>" class="validate" required />
                    <label for="birthDate">Date de naissance</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">email</i>
                    <input  type="email" name="mail" id="mail" placeholder="exemple@exemple.fr" value="<?= isset($mail) ? $mail : '' ?>" class="validate" required />
                    <label for="mail">Mail</label>
                </div>
            </div>
            <!--Champs mot de passe et vérification mot de passe-->
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">edit</i>
                    <input type="password" name="password" id="password" class="validate" required />
                    <label for="password">Mot de passe</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">edit</i>
                    <input  type="password" name="checkPassword" id="checkPassword" class="validate" required />
                    <label for="checkPassword">Vérification du mot de passe</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="inscriptionUserSubmit">Créer un compte</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>