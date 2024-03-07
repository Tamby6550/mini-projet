<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto as DtoEntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto as DtoSearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\UserStandardType;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield FormField::addTab('Information Entreprise');
        yield TextField::new('logo');
        yield TextEditorField::new('turnover');
        yield TextEditorField::new('website');
        yield FormField::addTab('Information employé');
        yield CollectionField::new('usersStandards')
            ->setEntryType(UserStandardType::class)
            ->setFormTypeOptions([
                'by_reference' => false,
            ]);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['id' => 'DESC']) // Optional: set default sorting
            ->setEntityPermission('ROLE_ADMIN') // Optional: set permission for accessing this entity
            ->setSearchFields(['id', 'logo', 'turnover', 'website']) // Optional: specify fields to search in
            ->setPaginatorPageSize(10); // Optional: set pagination size
    }

    public function createEntity(string $entityFqcn)
    {
        $company = new Company();
        $company->addUserId($this->getUser()); // Set the user ID to the currently logged-in user
        return $company;
    }


    public function createIndexQueryBuilder(DtoSearchDto $searchDto, DtoEntityDto $entityDto, FieldCollection $fields, \EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $qb->leftJoin('entity.userId', 'u')
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $this->getUser()->getId());

        return $qb;
    }
}
