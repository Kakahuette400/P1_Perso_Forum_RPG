<?php

namespace App\DataFixtures;

use App\Entity\Act;
use App\Entity\Perso;
use App\Entity\Dialog;
use App\Entity\Message;
use App\Entity\Post;
use App\Entity\RolePlay;
use App\Entity\Script;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SiteFixtures extends Fixture
{
    public function __construct(protected UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 5; $i++) {
            $user = new User;
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                "password"
            );

            $user->setEmail($faker->email())
                ->setUsername($faker->firstName())
                ->setRoles(["ROLE_USER"])
                ->setPassword($hashedPassword)
                ->setIsVerified(1);

            $manager->persist($user);


            for ($a = 0; $a < 1; $a++) {
                $perso = new Perso();
                $perso->setName($faker->name())
                    ->setFirstName($faker->firstName())
                    ->setAge($faker->numberBetween(16, 38))
                    ->setJob($faker->jobTitle())
                    ->setBody($faker->text(205))
                    ->setMind($faker->text(205))
                    ->setStory($faker->text(205))
                    ->setAvatar($faker->text(255))
                    ->setColor($faker->colorName())
                    ->setUser($user);


                $manager->persist($perso);

                for ($u = 0; $u < 1; $u++) {
                    $script = new Script();
                    $script->setTitle($faker->text(15))
                    ->setDescription($faker->text(255));

                    $manager->persist($script);


                    for ($o = 0; $o < 2; $o++) {
                        $act = new Act();
                        $act->setTitle($faker->text(10))
                            ->setScript($script);

                        $manager->persist($act);


                        for ($p = 0; $p < 3; $p++) {
                            $rp = new RolePlay();
                            $rp->setTitle($faker->text(25))
                                ->setAct($act)
                                ->setDate($faker->dateTime())
                                ->setLocation($faker->city())
                                ->setSummarize($faker->text(255))
                                ->setStatus($faker->boolean());

                            $manager->persist($rp);

                            for ($x = 0; $x < 2; $x++) {
                                $post = new Post();
                                $post->setRP($rp)
                                    ->setPerso($perso);

                                $manager->persist($post);


                                for ($z = 0; $z < 5; $z++) {
                                    $message = new Message();
                                    $message->setText($faker->realText(255))
                                        ->setPerso($perso)
                                        ->setPost($post);


                                    $manager->persist($message);

                                    for ($l = 0; $l < 5; $l++) {
                                        $dialog = new Dialog;
                                        $dialog->setPnj($faker->boolean)
                                            ->setText($faker->realText(255))
                                            ->setPerso($perso)
                                            ->setPost($post);


                                        $manager->persist($dialog);

                                    }
                                }
                            }
                        }
                    }

                }
            }

            $manager->flush();
        }
    }


}
