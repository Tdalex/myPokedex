-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 14 Juillet 2017 à 16:31
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mypokedex`
--

-- --------------------------------------------------------

--
-- Structure de la table `lastseen`
--

CREATE TABLE `lastseen` (
  `id` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `ville` varchar(50) NOT NULL,
  `id_pokemon` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `id_national` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `typeA` varchar(45) NOT NULL,
  `typeB` varchar(45) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pokemon`
--

INSERT INTO `pokemon` (`id`, `id_national`, `name`, `typeA`, `typeB`, `parent_id`, `description`) VALUES
(1, 1, 'Bulbizarre', 'Plante', 'Poison', NULL, 'Il a une étrange graine plantée sur son dos. Elle grandit avec lui depuis sa naissance.Il peut survivre plusieurs jours sans manger. Le bulbe de son dos enmagasine de l\'énergie.'),
(2, 2, 'Herbizarre', 'Plante', 'Poison', 1, 'Son bulbe dorsal devient si gros qu\'il ne peut plus tenir sur ses membres postérieurs.En emmagasinant de l\'énergie, son bulbe grossit. Il en émane un arôme quand il va éclore.'),
(3, 3, 'Florizarre', 'Plante', 'Poison', 2, 'Sa plante mûrit en absorbant les rayons du soleil. Il migre souvent vers les endroits ensoleillés.Les pétales de sa fleur dorsale absorbent les rayons du soleil pour en faire de l\'énergie.'),
(4, 4, 'Salamèche', 'Feu', NULL, NULL, 'Il préfère les endroits chauds. En cas de pluie, de la vapeur se forme autour de sa queue.La flammèche au bout de sa queue émet un son crépitant audible seulement dans un endroit calme.'),
(5, 5, 'Reptincel', 'Feu', NULL, 4, 'En agitant sa queue, il peut élever le niveau de la température à un degré incroyable.Ce Pokémon est violent. Dans la furie d\'un combat son aura brille d\'une flamme bleutée.'),
(6, 6, 'Dracaufeu', 'Feu', 'Vol', 5, 'Il peut fondre la roche de son souffle brûlant. Il est souvent la cause de nombreux incendies.Quand il crache son souffle brûlant, la flamme au bout de sa queue s\'embrase.'),
(7, 7, 'Carapuce', 'Eau', NULL, NULL, 'Son dos durcit avec l\'âge et devient une super carapace. Il peut cracher des jets d\'écume.Caché sous l\'eau, il crache un jet d\'eau sur sa proie et se cache à l\'intérieur de sa coquille.'),
(8, 8, 'Carabaffe', 'Eau', NULL, 7, 'Il se cache au fond de l\'eau pour guetter sa proie. Ses oreilles sont des gouvernails.Attaqué, il cache sa tête dans sa carapace, mais son corps trop gros ne peut y tenir en entier.'),
(9, 9, 'Tortank', 'Eau', NULL, 8, 'Un Pokémon brutal armé de canons hydrauliques. Ses puissants jets d\'eau sont dévastateurs.Une fois sa cible alignée, il projette des jets d\'eau plus puissants qu\'une lance à incendie.'),
(10, 10, 'Chenipan', 'Insecte', NULL, NULL, 'Ses petites pattes sont équipées de ventouses, lui permettant de grimper aux murs.Quand on touche l\'appendglace sur son front, il sécrète un gaz puant pour se protéger.'),
(11, 11, 'Chrysacier', 'Insecte', NULL, 10, 'Il est vulnérable aux attaques tant que sa carapace fragile expose son corps tendre et mou.Il renforce sa carapace pour se protéger. Mais un coup puissant peut le déloger de son armure.'),
(12, 12, 'Papilusion', 'Insecte', 'Vol', 11, 'En combat, il bat des ailes très rapidement pour projeter des poudres toxiques sur ses ennemis.Ses ailes sont enduites d\'une poudre toxique imperméable. Il peut voler sous la pluie.'),
(13, 13, 'Aspicot', 'Insecte', 'Poison', NULL, 'Il se nourrit de feuilles dans les forêts. L\'aiguillon sur son front est empoisonné.Prenez garde à la pique empoisonnée sur son front. Il se cache dans les buissons et les hautes herbes.'),
(14, 14, 'Coconfort', 'Insecte', 'Poison', 13, 'Incapable de se déplacer de lui-même, il se défend en durcissant sa carapace.Il se déplace très lentement. Menacé, il sort son aiguillon et empoisonne ses ennemis.'),
(15, 15, 'Dardargnan', 'Insecte', 'Poison', 14, 'Il vole à très grande vitesse. Il se bat avec les dards empoisonnés de ses bras.Il se sert de ses trois aiguillons empoisonnés pour attaquer sans relâche ses adversaires.'),
(16, 16, 'Roucool', 'Normal', 'Vol', NULL, 'Il préfère les endroits chauds. En cas de pluie, de la vapeur se forme autour de sa queue.De nature très docile, il préfère jeter du sable pour se défendre plutôt qu\'attaquer.'),
(17, 17, 'Roucoups', 'Normal', 'Vol', 16, 'Il protège son territoire avec ardeur et repousse à coups de bec tout intrus.Ce Pokémon est très vivace. Il survole en permanence son territoire pour chasser.'),
(18, 18, 'Roucarnage', 'Normal', 'Vol', 17, 'Il chasse en survolant la surface de l\'eau et en plongeant pour attraper des proies faciles.Ce Pokémon vole à Mach 2 quand il chasse. Ses grandes griffes sont des armes redoutables.'),
(19, 19, 'Rattata', 'Normal', NULL, NULL, 'Sa morsure est très puissante. Petit et rapide, on en voit un peu partout.Il peut ronger n\'importe quoi. Quand on en voit un, il y en a certainement 40 dans le coin.'),
(20, 20, 'Rattatac', 'Normal', NULL, 19, 'Si ses moustaches sont coupées, il perd le sens de l\'équilibre et devient moins rapide.Ses pattes sont palmées. Il peut poursuivre sa proie à travers les cours d\'eau et les rivières.'),
(21, 21, 'Piafabec', 'Normal', 'Vol', NULL, 'Il chasse les insectes dans les hautes herbes. Ses petites ailes lui permettent de voler très vite.Incapable de voler à haute altitude, il se déplace très vite pour protéger son territoire'),
(22, 22, 'Rapasdepic', 'Normal', 'Vol', 21, 'Ses ailes géantes lui permettent de planer si longtemps qu\'il ne se pose que très rarement.Un Pokémon à qui on ne la fait pas. S\'il sent du danger, il fuit instantanément et à toute vitesse.'),
(23, 23, 'Abo', 'Poison', NULL, NULL, 'Il se déplace en silence pour dévorer des oeufs de Roucool ou de Piafabec.Plus il est âgé, plus son corps est long. Il se love autour des arbres pour se reposer.'),
(24, 24, 'Arbok', 'Poison', NULL, 23, 'Les motifs féroces peints sur son corps changent selon son environnement.Des études menées sur les motifs effrayants de son corps ont révélé six variations différentes.'),
(25, 25, 'Pikachu', 'Electrique', NULL, NULL, 'Quand plusieurs de ces Pokémon se réunissent, ils provoquent de gigantesques orages.Sa queue est dressée quand il est aux aguets. Si vous tirez dessus, il vous mordra.'),
(26, 26, 'Raichu', 'Electrique', NULL, 25, 'Il doit garder sa queue en contact ave le sol pour éviter toute électrocution.Il devient tout excité quand il emmagasine de l\'électricité. Il brille alors dans le noir.'),
(27, 27, 'Sabelette', 'Sol', NULL, NULL, 'Il s\'enterre dans les régions arides et désertiques. Il émerge seulement pour chasser.Son corps est sec. Quand la nuit déploie ses ailes de fraîcheur, son épiderme se couvre de rosée.'),
(28, 28, 'Sablaireau', 'Sol', NULL, 27, 'Il se roule en boule hérissée de piques s\'il est menacé. Il peut ainsi s\'enfuir ou attaquer.Ses griffes sont redoutables. Si une d\'elles se casse, elle repoussera en un jour.'),
(29, 29, 'Nidoran(femelle)', 'Poison', NULL, NULL, 'Ce Pokémon est hérissé de dards empoisonnés. Les femelles ont des dards plus petits.Un Pokémon paisible qui n\'aime pas se battre. Ses petites cornes sont empoisonnées.'),
(30, 30, 'Nidorina', 'Poison', NULL, 29, 'La corne de la femelle grandit lentement. Elle préfère attaquer avec ses griffes et sa gueule.Caché au fond de son terrier, ses cornes se rétractent. C\'est la preuve qu\'il est au repos.'),
(31, 31, 'Nidoqueen', 'Poison', 'Sol', 30, 'Ses écailles très résistantes et son corps massif sont des armes dévastatrglaces.Son corps musclé est recouvert de lourdes écailles. Elle poussent selon un cycle et un ordre précis.'),
(32, 32, 'Nidoran(mâle)', 'Poison', NULL, NULL, 'Son ouïe très fine l\'avertit du danger. Plus ses cornes sont grandes, plus son poison est mortel.Ses grandes oreilles sont toujours dressées. S\'il est menacé, il se défend avec un dard venimeux.'),
(33, 33, 'Nidorino', 'Poison', NULL, 32, 'Très agressif, il est prompt à répondre à la violence. La corne sur sa tête est venimeuse.Ses cornes sont venimeuses. Si elles touchent un ennemi, elles lui injectent un poison violent.'),
(34, 34, 'Nidoking', 'Poison', 'Sol', 33, 'Sa queue est une arme redoutable, il s\'en sert pour attraper sa proie et lui broyer les os.Ses charges sont dévastatrglaces grâce à sa peau d\'acier. Ses cornes percent même le diamant.'),
(35, 35, 'Mélofée', 'Fée', NULL, NULL, 'Très recherché pour son aura, il est très rare et ne vit que dans des endroits précis.Adoré pour son aspect mignon et joyeux, il est considéré comme rare. On en voit très peu.'),
(36, 36, 'Mélodelfe', 'Fée', NULL, 35, 'Une sorte de petite fée très rare. Il se cache en apercevant un être humain.Il défend son habitat avec courage. C\'est une sorte de fée qui ne se montre que rarement.'),
(37, 37, 'Goupix', 'Feu', NULL, NULL, 'Il n\'a qu\'une seule queue à la naissance. Sa queue se divise à la pointe au fil des ans.Sa fourrure et sa queue sont magnifiques. En grandissant sa queue se divise en six.'),
(38, 38, 'Feunard', 'Feu', NULL, 37, 'Très intelligent et rancunier. Attrapez-lui une de ses queues et il vous maudira pour 1000 ans.Selon la légende, 9 esprits se sont unis et incarnés dans ce Pokémon mystérieux et magique.'),
(39, 39, 'Rondoudou', 'Normal', 'Fée', NULL, 'Quand ses yeux s\'illuminent, il chante une mystérieuse berceuse.Son regard déstabilise ses adversaires. Il chante ensuite une berceuse qui les endort.'),
(40, 40, 'Grodoudou', 'Normal', 'Fée', 39, 'En cas de danger, il gonfle d\'air son corps doux et potelé dans des proportions gigantesques.Son corps est malléable. En aspirant de l\'air il se gonfle dans des proportions gigantesques.'),
(41, 41, 'Nosferapti', 'Poison', 'Vol', NULL, 'Se déplace en colonie dans les endroits sombres. Il s\'oriente grâce aux ultrasons.Il se dirige avec des ultrasons qui lui servent de sonar pour éviter les obstacles sur son trajet.'),
(42, 42, 'Nosferalto', 'Poison', 'Vol', 41, 'Une fois son adversaire mordu, il absorbera son énergie même s\'il devient trop gros pour voler.Il attaque par surprise et sans crier gare. Ses longues dents lui servent à sucer le sang.'),
(43, 43, 'Mystherbe', 'Plante', 'Poison', NULL, 'Pendant la journée, il se cache sous terre. Il s\'aventure la nuit pour planter des graines.Il est souvent confondu avec un radis noir. Si on essaye de le soulever du sol, il hurle.'),
(44, 44, 'Ortide', 'Plante', 'Poison', 43, 'Le liquide qui s\'écoule de sa bouche est comestible. Il sert à appâter sa proie.Il sent très mauvais ! Mais 1 personne sur 1000 aime la puanteur de son corps nauséabond.'),
(45, 45, 'Rafflesia', 'Plante', 'Poison', 44, 'Plus ses pétales sont grands, plus ils contiennent de pollen toxique.Il fait du bruit sourd quand il secoue ses pétales pour disperser son pollen empoisonné.'),
(46, 46, 'Paras', 'Insecte', 'Plante', NULL, 'Les champignons sur son dos se nourrissent des nutriments de leur hôte insectoïde.Il s\'enfouit sous terre pour ronger des racines afin de nourrir le champignon sur son dos.'),
(47, 47, 'Parasect', 'Insecte', 'Plante', 46, 'Une symbiose entre un parasite et un insecte. Le champignon a pris le contrôle de son hôte.Le champignon absorbe son hôte insectoïde. Il semble doué de facultés intellectuelles.'),
(48, 48, 'Mimitoss', 'Insecte', 'Poison', NULL, 'Il vit à l\'ombre des grands arbres où il mange des insectes. Il est attiré par la lumière.Ses grands yeux lui servent de radar. En pleine lumière on peut y distinguer des facettes.'),
(49, 49, 'Aéromite', 'Insecte', 'Poison', 48, 'Les motifs ocre de ses ailes changent en fonction de son type de poison.Les écailles de ses ailes sont inamovibles. Elles libèrent un poison violent au contact.'),
(50, 50, 'Taupiqueur', 'Sol', NULL, NULL, 'Il vit à un mètre sous la terre et se nourrit de racines. Il apparaît rarement à la surface.Il aime les lieux sombres. Il passe la majeure partie du temps sous terre ou dans des cavernes.'),
(51, 51, 'Triopiqueur', 'Sol', NULL, 50, 'Un groupe de Taupiqueur. Il crée des séismes en creusant à plus de 100 km de profondeur.Quand un de ces triplets creuse à plus de 90 Km/h, il provoque des tremblements de terre.'),
(52, 52, 'Miaouss', 'Normal', NULL, NULL, 'Il adore les pièces de monnaie. Il hante les rues à la recherche de pièces oubliées par les passantsIl est surtout actif la nuit. Il aime chaparder les objets ronds et brillants.'),
(53, 53, 'Persian', 'Normal', NULL, 52, 'Très apprécié pour sa fourrure, il est difficile à apprivoiser en raison de son caractère rétif.Sa démarche est souple et majestueuse. La pierre sur son front brille de mille feux.'),
(54, 54, 'Psykokwak', 'Eau', NULL, NULL, 'Il distrait ses ennemis avec des grimaces débiles et les attaque ensuite avec ses pouvoirs psy.Il est victime de violent maux de tête. Il utilise ses pouvoirs psy de façon discrète.'),
(55, 55, 'Akwakwak', 'Eau', NULL, 54, 'Il nage avec élégance le long des côtes. Il est souvent confondu avec le monstre japonais : Kappa.Ses membres fins et longs sont terminés par des nageoires qui lui permettent de nager élégamment.'),
(56, 56, 'Férosinge', 'Combat', NULL, NULL, 'Il se met en colère très vite. Calme et furieux, son humeur change d\'une seconde à l\'autre.Agile et rapide, ce Pokémon vit dans les arbres. Il est féroce et ne refuse jamais un combat.'),
(57, 57, 'Colossinge', 'Combat', NULL, 56, 'Agressif et teigneux, il poursuit son gibier jusqu\'à épuisement complet.Sa fureur prend fin quand il n\'a plus personne à frapper. Il est difficile d\'en être témoin.'),
(58, 58, 'Caninos', 'Feu', NULL, NULL, 'Pour protéger son territoire, il aboie et mord jusqu\'à ce que les intrus s\'enfuient.Ce Pokémon est de nature amicale. Mais il devient hargneux quand son territoire est menacé.'),
(59, 59, 'Arcanin', 'Feu', NULL, 58, 'Un Pokémon très recherché pour sa grâce légendaire. Son pas élégant semble glisser sur le vent.Un Pokémon légendaire en Chine. Il est admiré pour la grâce et la beauté de sa course'),
(60, 60, 'Ptitard', 'Eau', NULL, NULL, 'Il court mal avec ses petites pattes. Il préfère nager que de se tenir debout.Le sens de la spirale sur son ventre diffère selon son origine. Il préfère la nage à la marche.'),
(61, 61, 'Têtarte', 'Eau', NULL, 60, 'Amphibie, il peut vivre à l\'air libre mais il doit rester mouillé pour survivre.Attaqué, il se sert de sa spirale pour endormir sa proie. Il peut ainsi s\'enfuir.'),
(62, 62, 'Tartard', 'Eau', 'Combat', 61, 'Excellent nageur, il pratique le crawl ou la nage papillon mieux qu\'un champion olympique.Son corps très musclé lui permet de nager plus rapidement qu\'un champion olympique.'),
(63, 63, 'Abra', 'Psy', NULL, NULL, 'Son don de télépathie lui permet de sentir le danger et de se téléporter en un lieu sûr.Il dort 18 heures par jour. En cas de danger, il se téléporte vers un lieu sûr, même s\'il est assoupi.'),
(64, 64, 'Kadabra', 'Psy', NULL, 63, 'Son corps émet des ondes alpha provoquant des migraines à ceux qui se trouvent à proximité.Sa présence cause des événements étranges, comme des pendules marchant à l\'envers.'),
(65, 65, 'Alakazam', 'Psy', NULL, 64, 'Son super cerveau peut effectuer des opérations à la vitesse d\'un ordinateur. Il a un Q.I. de 5000.Ce Pokémon est très intelligent. Sa mémoire est immense, il retient tout ce qu\'il apprend.'),
(66, 66, 'Machoc', 'Combat', NULL, NULL, 'Il adore la musculation. Il pratique les arts martiaux pour devenir encore plus fort.Très puissant malgré sa petite taille, il est passé maître en plusieurs types d\'arts martiaux.'),
(67, 67, 'Machopeur', 'Combat', NULL, 66, 'Son corps est si puissant qu\'il lui faut une ceinture de force pour équilibrer ses mouvements.Sa ceinture sert à retenir son énergie. Sans elle, il serait invincible et incontrôlable.'),
(68, 68, 'Mackogneur', 'Combat', NULL, 67, 'Ses coups de poing sont si puissants qu\'ils font voler ses adversaires jusqu\'à l\'horizon.Un seul de ses bras peut bouger une montagne. Rien ne résiste aux quatre bras en même temps.'),
(69, 69, 'Chétiflor', 'Plante', 'Poison', NULL, 'Un Pokémon carnivore qui se nourrit de petits insectes. Ses racines servent d\'attaches.Il préfère les endroits chauds et humides. Il capture sa proie avec ses lianes pour la dévorer.'),
(70, 70, 'Boustiflor', 'Plante', 'Poison', 69, 'Il crache de la poudre toxique pour immobiliser sa proie et il l\'achève avec de l\'acide.Il peut avaler et digérer n\'importe quoi grâce à l\'hyperacidité de son estomac vorace.'),
(71, 71, 'Empiflor', 'Plante', 'Poison', 70, 'Il vit en colonie dans la jungle mais personne n\'en est jamais revenu vivant.Il attire sa proie avec une odeur de miel et l\'avale en entier. Il la digère en un seul jour.'),
(72, 72, 'Tentacool', 'Eau', 'Poison', NULL, 'Flottant au bord des côtes, les pêcheurs se font souvent arroser d\'acide quand ils en accrochent un.Certains échouent sur la plage et sèchent sur le sable. Poussez-les dans l\'eau et ils revivent.'),
(73, 73, 'Tentacruel', 'Eau', 'Poison', 72, 'Ses tentacules sont rétractés au repos. En situation de chasse, ils s\'allongent.Ses 80 tentacules sont extensibles et autonomes. Ils inoculent un poison au contact.'),
(74, 74, 'Racaillou', 'Roche', 'Sol', NULL, 'Il vit dans les plaines ou les montagnes. On le confond souvent avec un petit caillou.On en trouve près des sentiers de montagne. Si vous marchez dessus, ils s\'énervent et attaquent.'),
(75, 75, 'Gravalanch', 'Roche', 'Sol', 74, 'Pour se déplacer il dégringole le long des pentes. Il pulvérise tout obstacle sur son passage.Il dévale les pentes le long des montagnes, et traverse les obstacles en les pulvérisant.'),
(76, 76, 'Grolem', 'Roche', 'Sol', 75, 'Son corps de pierre est indestructible. Il peut supporter des explosions de dynamite.Son corps est blanc et tendre. Au contact de l\'air sa peau se solidifie en une armure.'),
(77, 77, 'Ponyta', 'Feu', NULL, NULL, 'Ses sabots sont plus résistants que le diamant. Il peut aplatir n\'importe quoi en le piétinant.Capable de sauter très haut, ses sabots et ses pattes peuvent absorber l\'impact de l\'atterrissage.'),
(78, 78, 'Galopa', 'Feu', NULL, 77, 'Doté d\'un esprit de compétition, il poursuit toute créature rapide pour la course.Il aime la course. Il poursuit tout ce qui va plus vite que lui. Question d\'honneur.'),
(79, 79, 'Ramoloss', 'Eau', 'Psy', NULL, 'Très lent et endormi, il lui faut 5 secondes pour ressentir la douleur d\'une attaque.Lent et stupide, il aime se la couler douce en observant l\'activité autour de lui.'),
(80, 80, 'Flagadoss', 'Eau', 'Psy', 79, 'Le Kokiyas accroché à la queue du Ramoloss se nourrit des restes de son hôte.Il se prélasse au soleil. Si le Kokiyas, accroché à sa queue s\'en va, il redevient un Ramoloss.'),
(81, 81, 'Magnéti', 'Electrique', 'Acier', NULL, 'Il contrôle la gravité pour pouvoir voler. Il attaque avec des cages-éclair.Sa nature défie les lois de la gravité. Il flotte grâce à un champ électromagnétique.'),
(82, 82, 'Magnéton', 'Electrique', 'Acier', 81, 'Constitué de Magneti reliés les uns aux autres, il apparaît lorsque le soleil brille.Il émet un signal radio étrange. Sa présence augmente la température de 1 degré dans un rayon de 1000 m.'),
(83, 83, 'Canarticho', 'Normal', 'Vol', NULL, 'Il utilise l\'oignon qu\'il a dans la bouche comme une épée d\'acier.Ils vivent près des roseaux. On en voit peu, ils sont peut-être en voie d\'extinction.'),
(84, 84, 'Doduo', 'Normal', 'Vol', NULL, 'Cette oiseau vole très mal mais court très vite. Il laisse de gigantesque empreintes de pas.Ses petites ailes ne lui permettent pas de voler, mais il peut courir très rapidement.'),
(85, 85, 'Dodrio', 'Normal', 'Vol', 84, 'Il élabore des plans complexes avec ses trois cerveaux. Une de ces têtes reste toujours éveillée.Quand une des 2 têtes d\'un Doduo se divise, il devient un Dodrio capable de courir à 60 km/h.'),
(86, 86, 'Otaria', 'Eau', NULL, NULL, 'La corne sur son front est très résistante. Elle lui sert à percer des blocs de glace.Il est à l\'aise dans les endroits froids et gelés. Il peut nager dans de l\'eau à 0 degré.'),
(87, 87, 'Lamantine', 'Eau', 'Glace', 86, 'Il emmagasine la chaleur dans son corps. Il peut nager dans l\'eau glacée à plus de 8 noeuds.Son corps entier est d\'une couleur blanc neige. Il peut nager au milieu des glacebergs.'),
(88, 88, 'Tadmorv', 'Poison', NULL, NULL, 'Vivant dans des tas d\'ordures, il se nourrit des déchets polluants rejetés par les usines.Ce tas d\'ordure concentrées sent très mauvais. Rien ne peut pousser son sillage putride.'),
(89, 89, 'Grotadmorv', 'Poison', NULL, 88, 'Il est recouvert d\'une épaisse couche toxique. Il laisse une trace empoisonnée derrière lui.Son odeur immonde provoque des évanouissements. Son odorat s\'est atrophié par sa propre puanteur.'),
(90, 90, 'Kokiyas', 'Eau', NULL, NULL, 'Protégé par une carapace très résistante, il est vulnérable quand celle-ci s\'ouvre.Sa coquille le protège de toute attaque. Si elle s\'ouvre son corps fragile devient vulnérable.'),
(91, 91, 'Crustabri', 'Eau', 'Glace', 90, 'Une fois menacé, il envoie de rapides volées de dards. Sa partie interne est inconnue.Sa coquille plus dure que le diamant le protège. Il peut envoyer des volées de dards.'),
(92, 92, 'Fantominus', 'Spectre', 'Poison', NULL, 'Ce Pokémon gazeux plonge ses victimes dans un profond sommeil sans qu\'elles ne s\'en aperçoivent.On en trouve dans les maisons en ruines. Il n\'a pas de forme bien définie car il est fait de gaz.'),
(93, 93, 'Spectrum', 'Spectre', 'Poison', 92, 'Il peut se glisser à travers les murs comme une créature d\'une autre dimension.Les tremblements provoqués par le contact de sa langue éthérée ne s\'arrêtent qu\'à l\'évanouissement.'),
(94, 94, 'Ectoplasma', 'Spectre', 'Poison', 93, 'Les nuits de pleine lune, il imite l\'ombre des passants et se moque de leur effroi.Quand il lance une malédiction, il émet une aura malveillante qui provoque des frissons.'),
(95, 95, 'Onyx', 'Roche', 'Sol', NULL, 'Les parties en pierre de son corps durcissent pour devenir comme un diamant de couleur noire.Il creuse sous terre en quête de nourriture. Ses tunnels servent de maison aux Taupiqueur.'),
(96, 96, 'Soporifik', 'Psy', NULL, NULL, 'Il endort ses ennemis et dévore leurs songes. En mangeant de mauvais rêves, il devient malade.Si vous dormez près de lui, il influencera vos rêves avec les songes qu\'il a dévorés.'),
(97, 97, 'Hypnomade', 'Psy', NULL, 96, 'En fixant son adversaire, il l\'assaille avec les attaques psy d\'hypnose et de choc mental.Evitez son regard quand vous en croisez un, ou il essayera de vous hypnotiser avec son pendule'),
(98, 98, 'Krabby', 'Eau', NULL, NULL, 'Ses pinces sont des armes très puissantes. Elles lui servent aussi à garder son équilibre.Ses pinces sont de puissantes armes. Si une se casse durant un combat, elle repoussera vite.'),
(99, 99, 'Krabboss', 'Eau', NULL, 98, 'Son énorme pince peut déployer une pression de 1000 Kg. Mais elle est très encombrante.Sa pince, grosse et dure comme de l\'acier, peut déployer une pression de 100 tonnes.'),
(100, 100, 'Voltorbe', 'Electrique', NULL, NULL, 'Vivant dans les centrales, ce Pokémon survolté est souvent confondu avec une PokéBall.On dit qu\'il se déguise en PokéBall. Il s\'autodétruira à la moindre stimulation.'),
(101, 101, 'Electrode', 'Electrique', NULL, 100, 'Il emmagasine des quantités énormes de courants électriques sous pression pouvant exploser.Il stocke de l\'énergie électrique dans son corps, ce qui le rend instable et explosif.'),
(102, 102, 'Noeunoeuf', 'Plante', 'Psy', NULL, 'Souvent pris pour des oeufs, il attaquent en groupe comme un essaim.Les têtes sont attirées les unes vers les autres. Il en faut 6 pour qu\'il établisse son équilibre.'),
(103, 103, 'Noadkoko', 'Plante', 'Psy', 102, 'On raconte que si une de ses têtes se détache, elle se transforme en un Noeunoeuf.Son hurlement est strident car ses 3 têtes se chamaillent tout le temps.'),
(104, 104, 'Osselait', 'Sol', NULL, NULL, 'Il ne retire jamais son casque en os. Personne n\'a jamais vu le visage de ce Pokémon.Il porte le crâne de sa défunte mère. Ses pleurs résonnent dans son casque en une triste mélodie.'),
(105, 105, 'Ossatueur', 'Sol', NULL, 104, 'L\'os qu\'il tient dans sa main est une arme. Il peut le lancer avec adresse pour assommer sa proie.Petit et faible, ce Pokémon est habile avec sa masse en os. Il devient vicieux avec l\'âge.'),
(106, 106, 'Kicklee', 'Combat', NULL, NULL, 'S\'il est pressé, ses jambes s\'allongent progressivement. Il court alors très rapidement.Quand il donne des coups de pieds, ceux-ci deviennent durs comme le diamant.'),
(107, 107, 'Tygnon', 'Combat', NULL, NULL, 'Il distribue des séries de coups de poing rapides comme l\'éclair, invisibles à l\'oeil nu.Ses coups de poings rotatifs sont si puissants qu\'il peut forer le béton comme un marteau-piqueur.'),
(108, 108, 'Excelangue', 'Normal', NULL, NULL, 'Il peut projeter sa langue comme un caméléon. Tout contact avec elle provoque une irritation.Sa langue mesure 2m  et elle est plus maniable que ses pattes. Son contact provoque la paralysie.'),
(109, 109, 'Smogo', 'Poison', NULL, NULL, 'Son corps, constitué de gaz toxiques et instables, peut exploser soudainement.Dans des endroits chauds, son corps fait de gaz devient instable et peut exploser. Attention !'),
(110, 110, 'Smogogo', 'Poison', NULL, 109, 'Deux Smogo peuvent se combiner en un Smogogo en mélangeant leurs gaz.Ce Pokémon se nourrit de gaz, de poisons, et de germes que l\'on peut trouver dans des tas d\'ordures.'),
(111, 111, 'Rhinocorne', 'Sol', 'Roche', NULL, 'Avec une ossature 1000 fois plus résistante que celle de l\'homme, ses charges sont dévastatrglaces.Un Pokémon qui a des oeillères. S\'il se met à charger, il ne s\'arrêtera qu\'à l\'épuisement.'),
(112, 112, 'Rhinoféros', 'Sol', 'Roche', 111, 'Son épiderme très épais lui permet de survivre dans un environnement de plus de 3600 degrés.Il peut se tenir debout. Il semble un peu intelligent. Son épiderme résiste même à la lave.'),
(113, 113, 'Leveinard', 'Normal', NULL, NULL, 'Un Pokémon rare et difficile à capturer qui porte chance et bien-être à son possesseur.Il est gentil et aimable, et il partage ses oeufs nourrissants avec les Pokémon blessés.'),
(114, 114, 'Saquedeneu', 'Plante', NULL, NULL, 'Son corps est recouvert de lianes similaires à des algues. Elles bougent quand il marche.Son corps est masqué par une masse épaisse de lianes bleues qui poussent en permanence.'),
(115, 115, 'Kangourex', 'Normal', NULL, NULL, 'Son enfant ne quitte la poche ventrale protectrglace qu\'à l\'âge de trois ans.Il élève son petit dans sa poche ventrale. Il ne l\'abandonne jamais dans un combat.'),
(116, 116, 'Hypotrempe', 'Eau', NULL, NULL, 'Il peut nager à l\'envers en agitant ses petites nageoires pectorales.Menacé, il crache un jet d\'encre ou d\'eau de sa bouche pour se défendre.'),
(117, 117, 'Hypocéan', 'Eau', NULL, 116, 'Il peut nager à l\'envers en agitant ses petites nageoires pectorales.Le contact de sa nageoire provoque une irritation. Il ancre sa queue au corail pour dormir.'),
(118, 118, 'Poissirène', 'Eau', NULL, NULL, 'Très lent et endormi, il lui faut 5 secondes pour ressentir la douleur d\'une attaque.Quand survient la saison de ponte, on peut en voir dans les rivières et les cascades en larges groupes.'),
(119, 119, 'Poissoroy', 'Eau', NULL, 118, 'Pendant la saison des amours, on peut le voir nager près des rivières ou des lacs.Le mâle utilise la corne placée sur son front pour creuser un nid dans la rivière.'),
(120, 120, 'Stari', 'Eau', NULL, NULL, 'Un Pokémon bien curieux qui peut régénérer ses appendglaces sectionnés lors d\'un combat.Tant que sa partie centrale est indemne, il peut régénérer les parties de son corps.'),
(121, 121, 'Staross', 'Eau', 'Psy', 120, 'Son coeur brille des couleurs de l\'arc en ciel. On raconte que c\'est une pierre précieuse.Quand le centre de son corps, appelé le coeur, brille de 7 couleurs, il essaie de parler.'),
(122, 122, 'M. Mime', 'Psy', 'Fée', NULL, 'Dérangez-le pendant qu\'il mime et il se battra en distribuant des volées de claques.Il est toujours en train de mimer. Il leurre ses ennemis en mimant des actions irréelles.'),
(123, 123, 'Insécateur', 'Insecte', 'Vol', NULL, 'Rapide et agile comme un ninja, il se déplace si vite qu\'il crée l\'illusion d\'être en groupe.Bondissant hors de \'herbe comme un ninja, il lacère sa proie de ses griffes acérées.'),
(124, 124, 'Lippoutou', 'Glace', 'Psy', NULL, 'Il ondule ses hanches en marchant et entraîne les gens dans des danses frénétiques.Il bouge en rythme comme s\'il dansait. Il ondule du popotin quand il marche.'),
(125, 125, 'Elektek', 'Electrique', NULL, NULL, 'Vivant dans les centrales, il provoque des pannes de courant en s\'aventurant en ville.Il provoque des pannes de courants dans les centrales en mangeant de l\'électricité.'),
(126, 126, 'Magmar', 'Feu', NULL, NULL, 'Son corps fusion brûle d\'une flamme orangée, le rendant invisible dans le feu.Né dans un volcan en fusion, son corps est recouvert de flammes, comme une boule de feu.'),
(127, 127, 'Scarabrute', 'Insecte', NULL, NULL, 'Quand il ne peut pas écraser sa proie avec sa pince, il la secoue et l\'envoie dans les airs.Il enserre sa proie de sa puissance pince. Il ne peut se déplacer dans les milieux froids.'),
(128, 128, 'Tauros', 'Normal', NULL, NULL, 'Une fois sa cible en vue, il la charge furieusement en fouettant l\'air de sa queue.C\'est un Pokémon très endurant. Il n\'achève sa charge qu\'une fois sa cible pulvérisée.'),
(129, 129, 'Magicarpe', 'Eau', NULL, NULL, 'Autrefois, il était beaucoup plus puissant que cette créature minablement faible.Célèbre pour son inutilité, on en trouve beaucoup dans les océans, les étangs et les rivières.'),
(130, 130, 'Léviator', 'Eau', 'Vol', 129, 'Gigantesque et maléfique, il est capable de raser une ville dans un accès de rage terrifiante.Brutal, vicieux et dangereux, il est connu pour avoir rasé des villes entières par le passé.'),
(131, 131, 'Lokhlass', 'Eau', 'Glace', NULL, 'Ce Pokémon en voie d\'extinction peut transporter des passagers sur son dos par-delà les océans.D\'une âme noble, il peut lire dans les esprits. Il transporte les humains sur son dos.'),
(132, 132, 'Métamorph', 'Normal', NULL, NULL, 'Il est capable de copier le code génétique d\'un ennemi pour se transformer en son double.Quand il repère un ennemi, il adapte sa forme pour en faire une copie parfaite.'),
(133, 133, 'Evoli', 'Normal', NULL, NULL, 'Sa génétique particulière lui permet d\'évoluer s\'il est exposé aux radiations d\'une pierre.Sa génétique instable lui permet d\'évoluer de plusieurs façons. Très peu sont en vie.'),
(134, 134, 'Aquali', 'Eau', NULL, 133, 'Il vit au bord de l\'eau. Sa queue lui donne l\'apparence d\'une sirène.Sa structure cellulaire est semblable à celle de l\'eau. Il est invisible en milieu aquatique.'),
(135, 135, 'Voltali', 'Electrique', NULL, 133, 'Il se charge d\'électricité statique pour envoyer des décharges de 10 000 Volts.Un Pokémon très sensible et lunatique. Il se charge en énergie selon son humeur.'),
(136, 136, 'Pyroli', 'Feu', NULL, 133, 'Il peut accumuler suffisamment de chaleur pour atteindre des températures de 1600 degrés.Une flamme brûle en permanence dans son corps. Il crache un feu de plus de 1000 degrés.'),
(137, 137, 'Porygon', 'Normal', NULL, NULL, 'Un Pokémon fait de programmes d\'algorithmes. Il peut survivre en milieu virtuel.Conçu pour voler dans l\'espace, on ne lui a toujours pas trouvé une autre utilité.'),
(138, 138, 'Amonita', 'Roche', 'Eau', NULL, 'Disparu depuis longtemps, il peut être réanimé génétiquement à partir d\'anciens fossiles.Un ancien Pokémon régénéré à partir d\'un fossile. Il nage grâce à ses 10 tentacules.'),
(139, 139, 'Amonistar', 'Roche', 'Eau', 138, 'Un Pokémon préhistorique qui disparut quand sa coquille devint trop lourde à déplacer.Sa bouche est formée de becs aiguisés. Sa coquille trop lourde l\'empêche de se déplacer.'),
(140, 140, 'Kabuto', 'Roche', 'Eau', NULL, 'Un Pokémon reconstitué à partir d\'un fossile trouvé dans un site préhistorique.Créé à partir d\'un fossile, il se sert des yeux dans son dos quand il se cache au fond de l\'eau.'),
(141, 141, 'Kabutops', 'Roche', 'Eau', 140, 'Sa forme élancée lui permet de nager rapidement. Il lacère sa proie avant d\'en absorber la vie.C\'est un très bon nageur. Il lacère sa proie de ses longues griffes et en absorbe les fluides corporels.'),
(142, 142, 'Ptéra', 'Roche', 'Vol', NULL, 'Un Pokémon préhistorique qui attaque son ennemi à la gorge avec ses crocs acérés.Un Pokémon sauvage disparu il y a longtemps. Il est créé à partir d\'ADN fossilisé dans de l\'ambre.'),
(143, 143, 'Ronflex', 'Normal', NULL, NULL, 'Très paresseux, il ne fait que manger et dormir. Plus il est gros, plus il devient fainéant.Il peut tout manger, même de la nourriture avariée. Il n\'a jamais mal au ventre.'),
(144, 144, 'Artikodin', 'Glace', 'Vol', NULL, 'Le légendaire oiseau des glaces. On dit qu\'il apparaît aux gens perdus dans les sommets.Un Pokémon légendaire. Il glace la vapeur d\'eau contenue dans l\'air pour faire de la neige.'),
(145, 145, 'Electhor', 'Electrique', 'Vol', NULL, 'L\'oiseau légendaire de la foudre. Il surgit hors des nuages en lançant d\'énormes éclairs.Ce Pokémon légendaire annonce l\'arrivée de nuages noirs, d\'éclairs et d\'averses.'),
(146, 146, 'Sulfura', 'Feu', 'Vol', NULL, 'Le légendaire oiseau du feu. Une pluie de flammes surgit à chaque battement de ses ailes.Quand ce Pokémon légendaire agite ses ailes de feu, même la nuit noire s\'embrase et rougeoie.'),
(147, 147, 'Minidraco', 'Dragon', NULL, NULL, 'Longtemps considéré comme légendaire, une colonie fut découverte dans les océans.L\'existence de ce Pokémon mythique ne fut confirmée que récemment par un pêcheur.'),
(148, 148, 'Draco', 'Dragon', NULL, 147, 'Un Pokémon légendaire plein de charme. Il peut contrôler les variations climatiques.Selon certains, son corps est baigné d\'une étrange aura, lui donnant un air mystique.'),
(149, 149, 'Dracolosse', 'Dragon', 'Vol', 148, 'Un Pokémon marin extrêmement rare. On dit qu\'il est aussi intelligent que l\'homme.On raconte que ce Pokémon vit quelque part dans la mer et qu\'il peut voler. rien n\'est moins sûr.'),
(150, 150, 'Mewtwo', 'Psy', NULL, NULL, 'Il est le fruit de nombreuses expériences génétiques horribles et malsaines.Son ADN est le même que celui de MEW mais sa taille et son aspect sont très différents.'),
(151, 151, 'Mew', 'Psy', NULL, NULL, 'Unique et rare, son existence est remise en cause par les experts. Peu nombreux sont ceux qui l\'ont vu.Vu au microscope, le pelage de ce Pokémon est fin, soyeux et très délicat.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user`
(
         `id` int PRIMARY KEY NOT NULL,
         `first_name` varchar(50) NOT NULL,
         `last_name` varchar(50) NOT NULL,
         `email` varchar(100) NOT NULL,
         `password` char(60) NOT NULL,
         `created` int NOT NULL,
         `user_group` int DEFAULT NULL
);

ALTER TABLE `user` MODIFY `id` INT AUTO_INCREMENT;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `lastseen`
--
ALTER TABLE `lastseen`
  ADD PRIMARY KEY (`id`,`id_pokemon`),
  ADD KEY `fk_Last_seen_Pokemon_idx` (`id_pokemon`);

--
-- Index pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--

--
-- AUTO_INCREMENT pour les tables exportées
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lastseen`
--
ALTER TABLE `lastseen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `lastseen`
--
ALTER TABLE `lastseen`
  ADD CONSTRAINT `fk_Last_seen_Pokemon` FOREIGN KEY (`id_pokemon`) REFERENCES `pokemon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
