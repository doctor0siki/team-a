<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\DBAL\Platforms\Keywords;

/**
 * Drizzle Keywordlist.
 *
 * @author Kim Hemsø Rasmussen <kimhemsoe@gmail.com>
 */
class DrizzleKeywords extends KeywordList
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'drizzle';
    }

    /**
     * {@inheritdoc}
     */
    protected function getKeywords()
    {
        return [
            'ABS',
            'ALL',
            'ALLOCATE',
            'ALTER',
            'AND',
            'ANY',
            'ARE',
            'ARRAY',
            'AS',
            'ASENSITIVE',
            'ASYMMETRIC',
            'AT',
            'ATOMIC',
            'AUTHORIZATION',
            'AVG',
            'BEGIN',
            'BETWEEN',
            'BIGINT',
            'BINARY',
            'BLOB',
            'BOOLEAN',
            'BOTH',
            'BY',
            'CALL',
            'CALLED',
            'CARDINALITY',
            'CASCADED',
            'CASE',
            'CAST',
            'CEIL',
            'CEILING',
            'CHAR',
            'CHARACTER',
            'CHARACTER_LENGTH',
            'CHAR_LENGTH',
            'CHECK',
            'CLOB',
            'CLOSE',
            'COALESCE',
            'COLLATE',
            'COLLECT',
            'COLUMN',
            'COMMIT',
            'CONDITION',
            'CONNECT',
            'CONSTRAINT',
            'CONVERT',
            'CORR',
            'CORRESPONDING',
            'COUNT',
            'COVAR_POP',
            'COVAR_SAMP',
            'CREATE',
            'CROSS',
            'CUBE',
            'CUME_DIST',
            'CURRENT',
            'CURRENT_DATE',
            'CURRENT_DEFAULT_TRANSFORM_GROUP',
            'CURRENT_PATH',
            'CURRENT_ROLE',
            'CURRENT_TIME',
            'CURRENT_TIMESTAMP',
            'CURRENT_TRANSFORM_GROUP_FOR_TYPE',
            'CURRENT_USER',
            'CURSOR',
            'CYCLE',
            'DATE',
            'DAY',
            'DEALLOCATE',
            'DEC',
            'DECIMAL',
            'DECLARE',
            'DEFAULT',
            'DELETE',
            'DENSE_RANK',
            'DEREF',
            'DESCRIBE',
            'DETERMINISTIC',
            'DISCONNECT',
            'DISTINCT',
            'DOUBLE',
            'DROP',
            'DYNAMIC',
            'EACH',
            'ELEMENT',
            'ELSE',
            'END',
            'ESCAPE',
            'EVERY',
            'EXCEPT',
            'EXEC',
            'EXECUTE',
            'EXISTS',
            'EXP',
            'EXTERNAL',
            'EXTRACT',
            'FALSE',
            'FETCH',
            'FILTER',
            'FLOAT',
            'FLOOR',
            'FOR',
            'FOREIGN',
            'FREE',
            'FROM',
            'FULL',
            'FUNCTION',
            'FUSION',
            'GET',
            'GLOBAL',
            'GRANT',
            'GROUP',
            'GROUPING',
            'HAVING',
            'HOLD',
            'HOUR',
            'IDENTITY',
            'IN',
            'INDICATOR',
            'INNER',
            'INOUT',
            'INSENSITIVE',
            'INSERT',
            'INT',
            'INTEGER',
            'INTERSECT',
            'INTERSECTION',
            'INTERVAL',
            'INTO',
            'IS',
            'JOIN',
            'LANGUAGE',
            'LARGE',
            'LATERAL',
            'LEADING',
            'LEFT',
            'LIKE',
            'LN',
            'LOCAL',
            'LOCALTIME',
            'LOCALTIMESTAMP',
            'LOWER',
            'MATCH',
            'MAX',
            'MEMBER',
            'MERGE',
            'METHOD',
            'MIN',
            'MINUTE',
            'MOD',
            'MODIFIES',
            'MODULE',
            'MONTH',
            'MULTISET',
            'NATIONAL',
            'NATURAL',
            'NCHAR',
            'NCLOB',
            'NEW',
            'NO',
            'NONE',
            'NORMALIZE',
            'NOT',
            'NULL_SYM',
            'NULLIF',
            'NUMERIC',
            'OCTET_LENGTH',
            'OF',
            'OLD',
            'ON',
            'ONLY',
            'OPEN',
            'OR',
            'ORDER',
            'OUT',
            'OUTER',
            'OVER',
            'OVERLAPS',
            'OVERLAY',
            'PARAMETER',
            'PARTITION',
            'PERCENTILE_CONT',
            'PERCENTILE_DISC',
            'PERCENT_RANK',
            'POSITION',
            'POWER',
            'PRECISION',
            'PREPARE',
            'PRIMARY',
            'PROCEDURE',
            'RANGE',
            'RANK',
            'READS',
            'REAL',
            'RECURSIVE',
            'REF',
            'REFERENCES',
            'REFERENCING',
            'REGR_AVGX',
            'REGR_AVGY',
            'REGR_COUNT',
            'REGR_INTERCEPT',
            'REGR_R2',
            'REGR_SLOPE',
            'REGR_SXX',
            'REGR_SXY',
            'REGR_SYY',
            'RELEASE',
            'RESULT',
            'RETURN',
            'RETURNS',
            'REVOKE',
            'RIGHT',
            'ROLLBACK',
            'ROLLUP',
            'ROW',
            'ROWS',
            'ROW_NUMBER',
            'SAVEPOINT',
            'SCOPE',
            'SCROLL',
            'SEARCH',
            'SECOND',
            'SELECT',
            'SENSITIVE',
            'SESSION_USER',
            'SET',
            'SIMILAR',
            'SMALLINT',
            'SOME',
            'SPECIFIC',
            'SPECIFICTYPE',
            'SQL',
            'SQLEXCEPTION',
            'SQLSTATE',
            'SQLWARNING',
            'SQRT',
            'START',
            'STATIC',
            'STDDEV_POP',
            'STDDEV_SAMP',
            'SUBMULTISET',
            'SUBSTRING',
            'SUM',
            'SYMMETRIC',
            'SYSTEM',
            'SYSTEM_USER',
            'TABLE',
            'TABLESAMPLE',
            'THEN',
            'TIME',
            'TIMESTAMP',
            'TIMEZONE_HOUR',
            'TIMEZONE_MINUTE',
            'TO',
            'TRAILING',
            'TRANSLATE',
            'TRANSLATION',
            'TREAT',
            'TRIGGER',
            'TRIM',
            'TRUE',
            'UESCAPE',
            'UNION',
            'UNIQUE',
            'UNKNOWN',
            'UNNEST',
            'UPDATE',
            'UPPER',
            'USER',
            'USING',
            'VALUE',
            'VALUES',
            'VARCHAR',
            'VARYING',
            'VAR_POP',
            'VAR_SAMP',
            'WHEN',
            'WHENEVER',
            'WHERE',
            'WIDTH_BUCKET',
            'WINDOW',
            'WITH',
            'WITHIN',
            'WITHOUT',
            'XML',
            'XMLAGG',
            'XMLATTRIBUTES',
            'XMLBINARY',
            'XMLCOMMENT',
            'XMLCONCAT',
            'XMLELEMENT',
            'XMLFOREST',
            'XMLNAMESPACES',
            'XMLPARSE',
            'XMLPI',
            'XMLROOT',
            'XMLSERIALIZE',
            'YEAR',
        ];
    }
}
