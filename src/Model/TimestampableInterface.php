<?php

namespace Mr\SimpleBehaviorsBundle\Model;

interface TimestampableInterface
{
    public function getCreatedAt(): ?\DateTimeImmutable;
    public function setCreatedAt(\DateTimeImmutable $createdAt): self;
    public function getUpdatedAt(): ?\DateTimeImmutable;
    public function setUpdatedAt(\DateTimeImmutable $updateAt) : self;
}
