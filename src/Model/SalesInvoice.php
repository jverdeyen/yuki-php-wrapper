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

use Yuki\Exception\InvalidValueTypeException;
use Yuki\Exception\NonAllowedEnumValueException;
use Yuki\ModelFactory;

/**
 * Description of SalesInvoice
 *
 * @author Bert Maurau
 */
class SalesInvoice
{
    private $paymentID;

    private $reference;

    private $subject;

    private $paymentMethod;

    private $process;

    private $emailToCustomer;

    private $layout;

    private $date;

    private $dueDate;

    private $priceList;

    private $currency;

    private $remarks;

    private $projectID;

    private $contact;

    private $contactPerson;

    private $invoiceLines = [];

    public function renderXml()
    {
        $xmlDoc = '<SalesInvoice>';
        $xmlDoc .= $this->recursiveXml($this);
        $xmlDoc .= '</SalesInvoice>';

        return $xmlDoc;
    }

    private function recursiveXml($elem)
    {
        $xmlDoc = '';
        $objects = (is_array($elem)) ? $elem : ((is_object($elem)) ? get_object_vars($elem) : exit());
        foreach ($objects as $property => $value) {
            $property = ucfirst($property);
            if (is_array($value)) {
                $xmlDoc .= '<'.$property.'>';
                foreach ($value as $index => $child) {
                    $xmlDoc .= '<'.ModelFactory::getName($child).'>';
                    $xmlDoc .= $this->recursiveXml($child);
                    $xmlDoc .= '</'.ModelFactory::getName($child).'>';
                }
                $xmlDoc .= '</'.$property.'>';
            } else {
                if (is_object($value)) {
                    $xmlDoc .= '<'.ModelFactory::getName($value).'>';
                    $xmlDoc .= $this->recursiveXml($value);
                    $xmlDoc .= '</'.ModelFactory::getName($value).'>';
                } else {
                    if ($value) {
                        $xmlDoc .= '<'.$property.'>'.$value.'</'.$property.'>';
                    }
                }
            }
        }

        return $xmlDoc;
    }

    public function addInvoiceLine(InvoiceLine $invoiceLine)
    {
        array_push($this->invoiceLines, $invoiceLine);

        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($paymentMethod)
    {
        $enum = [
            'Unspecified',
            'ElectronicTransfer',
            'DirectCollection',
            'Cash',
            'DebitCard',
            'CreditCard',
            'ReceivedElectronically',
            'ReceivedCash',
            'ToSettle',
            'iDeal',
            'Online',
        ];
        if (!in_array($paymentMethod, $enum)) {
            throw new NonAllowedEnumValueException(__CLASS__, 'PaymentMethod', $paymentMethod, json_encode($enum));
        }
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function getPriceList()
    {
        return $this->priceList;
    }

    public function setPriceList($priceList)
    {
        $this->priceList = $priceList;

        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function getRemarks()
    {
        return $this->remarks;
    }

    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact(Contact $contact)
    {
        $this->contact = $contact;

        return $this;
    }

    public function getInvoiceLines()
    {
        return $this->invoiceLines;
    }

    public function setInvoiceLines($invoiceLines)
    {
        $this->invoiceLines = $invoiceLines;

        return $this;
    }

    public function setDate($date)
    {
        try {
            $date = new \DateTime($date);
        } catch (Exception $ex) {
            throw new InvalidValueTypeException(__CLASS__, 'date', gettype($date), 'valid date');
        }
        $this->date = $date->format('Y-m-d');

        return $this;
    }

    public function setDueDate($dueDate)
    {
        try {
            $dueDate = new \DateTime($dueDate);
        } catch (Exception $ex) {
            throw new InvalidValueTypeException(__CLASS__, 'dueDate', gettype($dueDate), 'valid date');
        }
        $this->dueDate = $dueDate->format('Y-m-d');

        return $this;
    }

    public function setProcess($process)
    {
        if (!is_bool($process)) {
            throw new InvalidValueTypeException(__CLASS__, 'process', gettype($process), 'boolean');
        }
        $this->process = ($process) ? 'true' : 'false';

        return $this;
    }

    public function setEmailTocustomer($emailToCustomer)
    {
        if (!is_bool($emailToCustomer)) {
            throw new InvalidValueTypeException(__CLASS__, 'emailToCustomer', gettype($emailToCustomer), 'boolean');
        }
        $this->emailToCustomer = ($emailToCustomer) ? 'true' : 'false';

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjectID()
    {
        return $this->projectID;
    }

    /**
     * @param mixed $projectID
     */
    public function setProjectID($projectID)
    {
        $this->projectID = $projectID;
    }

    /**
     * @return mixed
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param mixed $contactPerson
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    public function getPaymentID()
    {
        return $this->paymentID;
    }

    public function setPaymentID($paymentID): void
    {
        $this->paymentID = $paymentID;
    }

}
