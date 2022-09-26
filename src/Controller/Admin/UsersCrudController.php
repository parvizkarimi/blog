<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsersCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Users::class;
  }


  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('firstname'),
      TextField::new('lastname'),
      EmailField::new('email'),
      TextField::new('password')->setFormType(PasswordType::class)->hideOnIndex(),
      DateTimeField::new('createdAt', 'Passée le')->setFormat('dd/MM/Y à H:m')->hideOnForm(),
    ];
  }
}
