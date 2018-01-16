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

namespace Yuki;

use Yuki\Exception\InvalidAdministrationIDException;
use Yuki\Exception\InvalidSessionIDException;
use Yuki\Exception\InvalidStatementLineException;
use Yuki\Exception\InvalidStatementTextException;

/**
 * Description of the Yuki PettyCash Sub service
 *
 * @author Bert Maurau
 */
class PettyCash extends Yuki
{

    const WS_SERVICE = 'Pettycash.asmx?WSDL';

    public function __construct()
    {
        parent::__construct(self::WS_SERVICE);
    }

    /**
     * Import Statement CSV string
     *
     * @param string $statementText
     *
     * @return stdclass
     * @throws \Exception
     */
    public function importStatementCSV($statementText)
    {
        // Check for sessionId first
        if (!$this->getSessionID()) {
            throw new InvalidSessionIDException();
        }
        // Check for sessionId first
        if (!$this->getAdministrationID()) {
            throw new InvalidAdministrationIDException();
        }
        // Check for given domain
        if (!$statementText) {
            throw new InvalidStatementTextException();
        }
        $request = [
            "sessionID" => $this->getSessionID(),
            "administrationID" => $this->getAdministrationID(),
            "statementText" => $statementText,
        ];

        try {
            $result = $this->soap->ImportStatement($request);
        } catch (\Exception $ex) {
            // Just pss the exception through and let the index handle the exception
            throw $ex;
        }

        return $result;
    }

    /**
     * Import a single Statement line
     *
     * @param \Yuki\Model\StatementLine $statementLine
     *
     * @return type
     * @throws Exception\InvalidStatementLineException
     * @throws \Exception
     */
    public function importStatementLine(Model\StatementLine $statementLine)
    {
        // Check for given StatementLine
        if (!$statementLine) {
            throw new InvalidStatementLineException();
        }
        $request = [
            "sessionId" => $this->getSessionID(),
            "accountGlCode" => $statementLine->getAccountGlCode(),
            "transactionCode" => $statementLine->getTransactionCode(),
            "offsetAccount" => $statementLine->getOffsetAccount(),
            "offsetName" => $statementLine->getOffsetName(),
            "transactionDate" => $statementLine->getTransactionDate(),
            "transactionDescription" => $statementLine->getTransactionDescription(),
            "amount" => $statementLine->getAmount(),
        ];

        try {
            $result = $this->soap->ImportSingleStatementLine($request);
        } catch (\Exception $ex) {
            // Just pss the exception through and let the index handle the exception
            throw $ex;
        }

        return $result;
    }

    /**
     * Import a single Statement Project line
     *
     * @param \Yuki\Model\StatementLineProject $statementLineProject
     *
     * @return type
     * @throws Exception\InvalidStatementLineException
     * @throws \Exception
     */
    public function importStatementLineProject(Model\StatementLineProject $statementLineProject)
    {
        // Check for given StatementLineProject
        if (!$statementLineProject) {
            throw new InvalidStatementLineException();
        }
        $request = [
            "sessionId" => $this->getSessionID(),
            "accountGlCode" => $statementLineProject->getAccountGlCode(),
            "transactionCode" => $statementLineProject->getTransactionCode(),
            "offsetAccount" => $statementLineProject->getOffsetAccount(),
            "offsetName" => $statementLineProject->getOffsetName(),
            "transactionDate" => $statementLineProject->getTransactionDate(),
            "transactionDescription" => $statementLineProject->getTransactionDescription(),
            "amount" => $statementLineProject->getAmount(),
            "projectCode" => $statementLineProject->getProjectCode(),
            "projectName" => $statementLineProject->getProjectName(),
        ];

        try {
            $result = $this->soap->ImportSingleStatementProjectLine($request);
        } catch (\Exception $ex) {
            // Just pss the exception through and let the index handle the exception
            throw $ex;
        }

        return $result;
    }

}
