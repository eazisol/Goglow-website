@extends('layouts.main')
{{-- Title --}}
@section('title', 'Privacy Policy')

{{-- Style Files --}}
@section('styles')
    <style>
        .privacy-policy {
            font-size: 13px;
        }
        p{
            margin-top: 10px;
            border-radius: 8px;
            background: aliceblue;
            padding: 10px;
        }
        .privacy-text ul li {
            padding-bottom: 8px;
            margin-bottom: 8px;
            margin-top: 8px;
        }

        .privacy-text ul li:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
    </style>
@endsection


{{-- Content --}}
@section('content')
    <!-- Page Header intentionally removed to match Terms layout -->
	

    <!-- Privacy Policy Section Start -->
    <div class="privacy-policy bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Privacy Content Start -->
                    <div class="privacy-content">
                        <div class="privacy-text">
                            {{-- <h2>GoGlow - Politique de Confidentialité</h2> --}}
                            <p class="text-end">Dernière mise à jour : 29 décembre 2025</p>
                            <div class="section-title">
                                <h3 class="wow">Privacy Policy</h3>
                            </div>
                            {{-- <h3>1. Responsable du Traitement</h3>
                            <p>[Nom de l'entreprise]<br>
                            [Adresse de l'entreprise, France/UE]<br>
                            Email : [Insérer l'email]<br>
                            Téléphone : [Insérer le numéro]<br>
                            Numéro SIRET : [Insérer le SIRET]</p> --}}
                            
                            <h3>1. Introduction</h3>
                            <p>Glaura s'engage à protéger vos données personnelles conformément au RGPD et à la législation française sous la supervision de la CNIL. Cette politique s'applique à tous les utilisateurs âgés de 16 ans et plus. Les utilisateurs de moins de 16 ans doivent fournir un consentement parental explicite en contactant dpo@glaura.ai.</p>
                            
                            <h3>2. Données Collectées</h3>
                            <ul>
                                <li><strong>Données d'identification :</strong> Nom, email (conservés pendant la durée du compte + 5 ans)</li>
                                <li><strong>Coordonnées :</strong> Numéro de téléphone (jusqu'à la suppression du compte)</li>
                                <li><strong>Données financières :</strong> Paiements (conservés pendant la transaction + 5–10 ans)</li>
                                <li><strong>Données de localisation :</strong> Localisation en temps réel pour afficher les salons proches (2 mois max)</li>
                                <li><strong>Historique et usage :</strong> Réservations, chat, notifications</li>
                                <li><strong>Données OAuth :</strong> Connexion sécurisée Google/Apple</li>
                                <li><strong>Journaux IP :</strong> 1 an</li>
                                <li><strong>Cookies :</strong> 13 mois max</li>
                                <li><strong>Consentement marketing :</strong> 3 ans après la dernière activité</li>
                                <li><strong>Enregistrements vocaux :</strong> 6 mois (5 ans pour appels contractuels)</li>
                            </ul>
                            
                            <h3>3. Identifiants d'Appareil et Autres Identifiants</h3>
                            <p>Notre application collecte automatiquement certains identifiants techniques nécessaires au bon fonctionnement des services :</p>
                            <ul>
                                <li><strong>Identifiant Firebase (Firebase Installation ID) :</strong> Utilisé pour les notifications push, l'authentification et les fonctionnalités en temps réel</li>
                                <li><strong>Identifiant d'appareil Android (Android ID) :</strong> Utilisé pour identifier de manière unique votre appareil afin d'assurer la sécurité du compte et prévenir la fraude</li>
                                <li><strong>Informations sur l'appareil :</strong> Modèle d'appareil, version du système d'exploitation, langue de l'appareil (utilisés pour l'optimisation de l'application et le support technique)</li>
                                <li><strong>Identifiants de session :</strong> Utilisés pour maintenir votre connexion et améliorer votre expérience utilisateur</li>
                            </ul>
                            <p><strong>Finalité :</strong> Ces identifiants sont collectés exclusivement pour :</p>
                            <ul>
                                <li>Envoyer des notifications push pertinentes (rappels de rendez-vous, confirmations)</li>
                                <li>Assurer l'authentification sécurisée de votre compte</li>
                                <li>Prévenir la fraude et garantir la sécurité de l'application</li>
                                <li>Améliorer les performances et diagnostiquer les problèmes techniques</li>
                            </ul>
                            <p><strong>Durée de conservation :</strong> Ces identifiants sont conservés pendant la durée d'utilisation de l'application. Ils sont supprimés dans les 30 jours suivant la suppression de votre compte ou la désinstallation de l'application.</p>
                            
                            <h3>4. Données issues des Réseaux Sociaux (Instagram / Meta)</h3>
                            <p>Lorsque les Prestataires de Services (Glowers / SP) choisissent de connecter leur compte Instagram à l'application Glaura, nous pouvons collecter certaines données via les API officielles de Meta (Instagram Graph API), uniquement après consentement explicite de l'utilisateur concerné.</p>
                            
                            <h4>Données collectées via Instagram</h4>
                            <p>Selon les autorisations accordées, nous pouvons accéder aux données suivantes :</p>
                            <ul>
                                <li>Contenus publics publiés sur Instagram (vidéos et médias)</li>
                                <li>Métadonnées associées aux publications (légendes, hashtags, date de publication)</li>
                                <li>Identifiant du compte Instagram professionnel connecté</li>
                            </ul>
                            
                            <h4>⚠️ Nous n'accédons jamais :</h4>
                            <ul>
                                <li>aux messages privés (DM)</li>
                                <li>à la liste complète des abonnés</li>
                                <li>aux données personnelles des abonnés</li>
                                <li>aux contenus privés ou stories</li>
                                <li>aux capacités de publication en votre nom</li>
                            </ul>
                            
                            <h4>Finalité de l'intégration Instagram</h4>
                            <p>Les données Instagram sont utilisées exclusivement pour :</p>
                            <ul>
                                <li>Afficher automatiquement sur Glaura les vidéos publiées par le Prestataire contenant le hashtag #glaura</li>
                                <li>Valoriser le profil professionnel du Prestataire dans l'application</li>
                                <li>Améliorer la visibilité des services proposés</li>
                            </ul>
                            <p>Aucune utilisation publicitaire externe ou revente de données n'est effectuée.</p>
                            
                            <h4>Base légale du traitement (RGPD)</h4>
                            <p>Le traitement des données issues d'Instagram repose sur :</p>
                            <ul>
                                <li>Le consentement explicite du Prestataire lors de la connexion de son compte Instagram</li>
                                <li>L'exécution du contrat liant le Prestataire à Glaura</li>
                            </ul>
                            <p>Le Prestataire peut retirer son consentement à tout moment en déconnectant son compte Instagram depuis l'application.</p>
                            
                            <h4>Durée de conservation – Données Instagram</h4>
                            <p>Les médias Instagram sont affichés tant que :</p>
                            <ul>
                                <li>le contenu existe sur Instagram</li>
                                <li>le hashtag #glaura est présent</li>
                                <li>le compte reste connecté à Glaura</li>
                            </ul>
                            <p>En cas de déconnexion du compte Instagram ou suppression du compte Glaura, les contenus sont supprimés immédiatement ou sous 30 jours maximum.</p>
                            
                            <h4>Partage et conformité Meta</h4>
                            <ul>
                                <li>Glaura respecte strictement les Meta Platform Terms et Instagram Graph API Policies</li>
                                <li>Aucune donnée Instagram n'est vendue, transférée ou exploitée hors du cadre fonctionnel décrit</li>
                                <li>Meta peut traiter certaines données conformément à sa propre politique de confidentialité</li>
                            </ul>
                            <p>🔗 Politique Meta : <a href="https://www.facebook.com/privacy/policy" target="_blank">https://www.facebook.com/privacy/policy</a></p>
                            
                            <h4>Sécurité et contrôle utilisateur</h4>
                            <ul>
                                <li>Connexion sécurisée via OAuth (Meta)</li>
                                <li>Accès révocable à tout moment</li>
                                <li>Journalisation et contrôle des accès internes</li>
                            </ul>
                            
                            <h3>5. Finalités du Traitement</h3>
                            <p>Nous utilisons vos données pour :</p>
                            <ul>
                                <li>Gérer les comptes et réservations</li>
                                <li>Traiter les paiements via Stripe (conforme PCI-DSS)</li>
                                <li>Fournir la messagerie sécurisée et les notifications</li>
                                <li>Afficher des services basés sur la localisation via l'API Google Maps</li>
                                <li>Améliorer l'application et assurer son intégrité</li>
                                <li>Fournir un support client</li>
                                <li>Marketing avec consentement explicite</li>
                                <li>Respecter les obligations légales</li>
                            </ul>
                            
                            <h3>6. Bases Légales</h3>
                            <ul>
                                <li>Exécution contractuelle</li>
                                <li>Intérêt légitime</li>
                                <li>Consentement (localisation, marketing, partage de contact)</li>
                                <li>Obligation légale (conformité UE)</li>
                            </ul>
                            
                            <h3>7. Partage de Données</h3>
                            <p>Nous ne vendons ni ne partageons vos données avec des tiers. Nous utilisons :</p>
                            <ul>
                                <li>Stripe pour les paiements</li>
                                <li>API Google Maps pour la localisation</li>
                                <li>Firebase ou autres hébergements conformes RGPD</li>
                            </ul>
                            
                            <h3>8. Hébergement et Transferts</h3>
                            <p>Toutes les données sont hébergées dans l'UE. Les transferts hors UE utilisent des Clauses Contractuelles Types (SCC) pour garantir la conformité RGPD.</p>
                            
                            <h3>9. Sécurité des Données</h3>
                            <p>Nous appliquons le chiffrement, les protocoles HTTPS, des audits de sécurité réguliers, des tests d'intrusion, la traçabilité des accès et des politiques internes. Le personnel reçoit une formation régulière.</p>
                            
                            <h3>10. Droits des Utilisateurs (RGPD)</h3>
                            <p>Vous avez le droit d'accéder, de corriger, d'effacer, de limiter, de vous opposer au traitement, de demander la portabilité et de définir des directives post-mortem. Contact : <a href="mailto:dpo@glaura.ai">dpo@glaura.ai</a>. Une preuve d'identité peut être exigée.</p>
                            
                            <h3>11. Durée de Conservation</h3>
                            <p>Les données sont conservées uniquement le temps nécessaire aux finalités décrites. En cas de suppression du compte, toutes les données sont définitivement effacées sous 30 jours, sauf obligations légales.</p>
                            
                            <h3>12. Account Deletion / Suppression de Compte</h3>
                            <p>You have the right to delete your account and all associated data at any time.</p>
                            
                            <h4>How to request deletion:</h4>
                            <ul>
                                <li><strong>In-App:</strong> Log in to the app, go to Profile > Settings, and tap "Delete Account".</li>
                                <li><strong>By Web/Email:</strong> If you cannot access the app, you can request deletion by emailing our Data Protection Officer at <a href="mailto:dpo@glaura.ai">dpo@glaura.ai</a> with the subject line "Account Deletion Request". Please provide your registered email address or phone number so we can verify your identity.</li>
                            </ul>
                            
                            <h4>Data Deletion & Retention:</h4>
                            <ul>
                                <li><strong>What is deleted:</strong> Your profile information, chat history, usage data, and authentication tokens will be permanently removed.</li>
                                <li><strong>Timeline:</strong> Data is deleted within 30 days of your request.</li>
                                <li><strong>What is kept:</strong> We may retain certain financial record data (e.g., transaction invoices) for a period of 5-10 years solely to comply with legal tax obligations.</li>
                            </ul>
                            
                            <h3>13. Confidentialité des Enfants</h3>
                            <p>Notre application n'est pas destinée aux enfants de moins de 13 ans. Nous ne collectons pas sciemment leurs données. Les utilisateurs de moins de 16 ans doivent fournir un consentement parental.</p>
                            
                            <h3>14. Cookies</h3>
                            <p>Les cookies sont utilisés pour améliorer l'expérience utilisateur et sont conservés 13 mois maximum. Consultez notre Politique de Cookies pour plus de détails.</p>
                            
                            <h3>15. Plaintes et CNIL</h3>
                            <p>Pour toute préoccupation, contactez notre DPO à <a href="mailto:dpo@glaura.ai">dpo@glaura.ai</a> ou la CNIL :</p>
                            <p>Commission Nationale de l'Informatique et des Libertés (CNIL)<br>
                            3 place de Fontenoy – TSA 80751, 75334 Paris Cedex 07<br>
                            Téléphone : 01.53.73.22.22<br>
                            <a href="https://www.cnil.fr" target="_blank">https://www.cnil.fr</a></p>
                            
                            <h3>16. Modifications</h3>
                            <p>Nous pouvons mettre à jour cette Politique de Confidentialité pour refléter les évolutions légales ou de service. La date de la dernière révision sera toujours indiquée.</p>
                        </div>
                    </div>
                    <!-- Privacy Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Privacy Policy Section End -->

@endsection


{{-- Scripts --}}
@section('scripts')


@endsection