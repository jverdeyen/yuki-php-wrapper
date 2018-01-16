<?php

/*
 * Copyright 2017 Bert Maurau.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Yuki\Model;

use Yuki\Exception\NonAllowedEnumValueException;

/**
 * Description of Contact
 *
 * @author Bert Maurau
 */
class Contact
{
    public $contactCode;

    public $fullName;

    public $firstName;

    public $middleName;

    public $lastName;

    public $gender;

    public $countryCode;

    public $city;

    public $zipcode;

    public $addressLine_1;

    public $addressLine_2;

    public $emailAddress;

    public $website;

    public $CoCNumber;

    public $VATNumber;

    public $contactType;

    public function getContactCode()
    {
        return $this->contactCode;
    }

    public function setContactCode($contactCode)
    {
        $this->contactCode = $contactCode;

        return $this;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $enum = ['Male', 'Female', 'Unknown'];
        if (!in_array($gender, $enum)) {
            throw new NonAllowedEnumValueException(__CLASS__, 'Gender', $gender, json_encode($enum));
        }
        $this->gender = $gender;

        return $this;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getAddressLine_1()
    {
        return $this->addressLine_1;
    }

    public function setAddressLine_1($addressLine_1)
    {
        $this->addressLine_1 = $addressLine_1;

        return $this;
    }

    public function getAddressLine_2()
    {
        return $this->addressLine_2;
    }

    public function setAddressLine_2($addressLine_2)
    {
        $this->addressLine_2 = $addressLine_2;

        return $this;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    public function getCoCNumber()
    {
        return $this->CoCNumber;
    }

    public function setCoCNumber($CoCNumber)
    {
        $this->CoCNumber = $CoCNumber;

        return $this;
    }

    public function getVATNumber()
    {
        return $this->VATNumber;
    }

    public function setVATNumber($VATNumber)
    {
        $this->VATNumber = $VATNumber;

        return $this;
    }

    public function getContactType()
    {
        return $this->contactType;
    }

    public function setContactType($contactType)
    {
        $enum = ['Person', 'Company'];
        if (!in_array($contactType, $enum)) {
            throw new NonAllowedEnumValueException(__CLASS__, 'ContactType', $contactType, json_encode($enum));
        }
        $this->contactType = $contactType;

        return $this;
    }

}
