<?php

namespace Domain\Business\Booking\ValueObject; 

final class Contacts {
   public function __construct(
       private array $items
   )
   {
       $this->items = [];
   }

   public function addContact(Contact $contact) : self {
       if (!in_array($contact,$this->items))
            $this->items[] = $contact;
       return $this;
   }

   public function getContacts() : array {
       return $this->items;
   }
}