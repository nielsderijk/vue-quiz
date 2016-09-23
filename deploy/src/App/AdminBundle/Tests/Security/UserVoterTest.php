<?php

namespace App\AdminBundle\Tests\Security;

use App\AdminBundle\Security\UserVoter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * @package App\AdminBundle\Tests\Security
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class UserVoterTest extends \PHPUnit_Framework_TestCase
{
    protected $token;

    protected function setUp()
    {
        $this->token = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
    }

    /**
     * @TODO Test 'granted' and 'denied' results.
     * @dataProvider getVoteTests
     * @param array $attributes
     * @param int   $expected
     */
    public function testVote(array $attributes, $expected)
    {
        $voter = new UserVoter();

        $this->assertSame($expected, $voter->vote($this->token, null, $attributes));
    }

    /**
     * @return array
     */
    public function getVoteTests()
    {
        return [
            [[], VoterInterface::ACCESS_ABSTAIN],
            [['FOO'], VoterInterface::ACCESS_ABSTAIN],
        ];
    }
}
