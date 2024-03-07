<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use App\Controller\Admin\SearchDto;
use App\Controller\Admin\EntityDto;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto as DtoEntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto as DtoSearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;



class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('logo'),
            TextEditorField::new('turnover'),
            TextEditorField::new('website'),
            //Add the user role ROLE_USER form the choice list the User entity
            

        ];
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
