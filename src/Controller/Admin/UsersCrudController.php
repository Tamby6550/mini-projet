<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto as DtoEntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto as DtoSearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('companies')
            ->setFormTypeOptions([
                'choice_label' => 'logo',
            ])
            ->setRequired(false);
        yield TextField::new('username');
        yield EmailField::new('email');
        yield TextField::new('number_siret')->setRequired(false);
        yield TelephoneField::new('phone_number')->setRequired(false);
        yield TextField::new('name_company')->setRequired(false);
        yield TelephoneField::new('company_phone_number')->setRequired(false);
    }

    // public function createIndexQueryBuilder(DtoSearchDto $searchDto, DtoEntityDto $entityDto, FieldCollection $fields, \EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection $filters): QueryBuilder
    // {
    //     $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
    //     $qb->leftJoin('entity.companies', 'c')
    //         ->andWhere('c.userId = :userId')
    //         ->setParameter('userId', $this->getUser()->getId());

    //     return $qb;
    // }
}
