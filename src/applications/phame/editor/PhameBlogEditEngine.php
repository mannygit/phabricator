<?php

final class PhameBlogEditEngine
  extends PhabricatorEditEngine {

  const ENGINECONST = 'phame.blog';

  public function getEngineName() {
    return pht('Blogs');
  }

  public function getEngineApplicationClass() {
    return 'PhabricatorPhameApplication';
  }

  public function getSummaryHeader() {
    return pht('Configure Phame Blog Forms');
  }

  public function getSummaryText() {
    return pht('Configure how blogs in Phame are created and edited.');
  }

  protected function newEditableObject() {
    return PhameBlog::initializeNewBlog($this->getViewer());
  }

  protected function newObjectQuery() {
    return id(new PhameBlogQuery())
      ->needProfileImage(true);
  }

  protected function getObjectCreateTitleText($object) {
    return pht('Create New Blog');
  }

  protected function getObjectEditTitleText($object) {
    return pht('Edit %s', $object->getName());
  }

  protected function getObjectEditShortText($object) {
    return $object->getName();
  }

  protected function getObjectCreateShortText() {
    return pht('Create Blog');
  }

  protected function getObjectName() {
    return pht('Blog');
  }

  protected function getObjectCreateCancelURI($object) {
    return $this->getApplication()->getApplicationURI('blog/');
  }

  protected function getEditorURI() {
    return $this->getApplication()->getApplicationURI('blog/edit/');
  }

  protected function getObjectViewURI($object) {
    return $object->getManageURI();
  }

  protected function getCreateNewObjectPolicy() {
    return $this->getApplication()->getPolicy(
      PhameBlogCreateCapability::CAPABILITY);
  }

  protected function buildCustomEditFields($object) {
    return array(
      id(new PhabricatorTextEditField())
        ->setKey('name')
        ->setLabel(pht('Name'))
        ->setDescription(pht('Blog name.'))
        ->setConduitDescription(pht('Retitle the blog.'))
        ->setConduitTypeDescription(pht('New blog title.'))
        ->setTransactionType(PhameBlogTransaction::TYPE_NAME)
        ->setValue($object->getName()),
      id(new PhabricatorTextEditField())
        ->setKey('subtitle')
        ->setLabel(pht('Subtitle'))
        ->setDescription(pht('Blog subtitle.'))
        ->setConduitDescription(pht('Change the blog subtitle.'))
        ->setConduitTypeDescription(pht('New blog subtitle.'))
        ->setTransactionType(PhameBlogTransaction::TYPE_SUBTITLE)
        ->setValue($object->getSubtitle()),
     id(new PhabricatorRemarkupEditField())
        ->setKey('description')
        ->setLabel(pht('Description'))
        ->setDescription(pht('Blog description.'))
        ->setConduitDescription(pht('Change the blog description.'))
        ->setConduitTypeDescription(pht('New blog description.'))
        ->setTransactionType(PhameBlogTransaction::TYPE_DESCRIPTION)
        ->setValue($object->getDescription()),
      id(new PhabricatorTextEditField())
        ->setKey('domainFullURI')
        ->setLabel(pht('Full Domain URI'))
        ->setControlInstructions(pht('Set Full Domain URI if you plan to '.
          'serve this blog on another hosted domain. Parent Site Name and '.
          'Parent Site URI are optional but helpful since they provide '.
          'a link from the blog back to your parent site.'))
        ->setDescription(pht('Blog full domain URI.'))
        ->setConduitDescription(pht('Change the blog full domain URI.'))
        ->setConduitTypeDescription(pht('New blog full domain URI.'))
        ->setValue($object->getDomainFullURI())
        ->setTransactionType(PhameBlogTransaction::TYPE_FULLDOMAIN),
      id(new PhabricatorTextEditField())
        ->setKey('parentSite')
        ->setLabel(pht('Parent Site Name'))
        ->setDescription(pht('Blog parent site name.'))
        ->setConduitDescription(pht('Change the blog parent site name.'))
        ->setConduitTypeDescription(pht('New blog parent site name.'))
        ->setValue($object->getParentSite())
        ->setTransactionType(PhameBlogTransaction::TYPE_PARENTSITE),
      id(new PhabricatorTextEditField())
        ->setKey('parentDomain')
        ->setLabel(pht('Parent Site URI'))
        ->setDescription(pht('Blog parent domain name.'))
        ->setConduitDescription(pht('Change the blog parent domain.'))
        ->setConduitTypeDescription(pht('New blog parent domain.'))
        ->setValue($object->getParentDomain())
        ->setTransactionType(PhameBlogTransaction::TYPE_PARENTDOMAIN),
      id(new PhabricatorSelectEditField())
        ->setKey('status')
        ->setLabel(pht('Status'))
        ->setTransactionType(PhameBlogTransaction::TYPE_STATUS)
        ->setIsConduitOnly(true)
        ->setOptions(PhameBlog::getStatusNameMap())
        ->setDescription(pht('Active or archived status.'))
        ->setConduitDescription(pht('Active or archive the blog.'))
        ->setConduitTypeDescription(pht('New blog status constant.'))
        ->setValue($object->getStatus()),
    );
  }

}
