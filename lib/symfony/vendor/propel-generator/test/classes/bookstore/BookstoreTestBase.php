<?php
/*
 *  $Id: BookstoreTestBase.php 502 2007-01-01 19:23:21Z heltem $
 *
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
 * and is licensed under the LGPL. For more information please see
 * <http://propel.phpdb.org>.
 */

require_once 'PHPUnit2/Framework/TestCase.php';
include_once 'bookstore/BookstoreDataPopulator.php';

/**
 * Base class contains some methods shared by subclass test cases.
 */
abstract class BookstoreTestBase extends PHPUnit2_Framework_TestCase {

	/**
	 * This is run before each unit test; it populates the database.
	 */
	public function setUp()
	{
		parent::setUp();
		BookstoreDataPopulator::populate();
	}

	/**
	 * This is run after each unit test.  It empties the database.
	 */
	public function tearDown()
	{

		BookstoreDataPopulator::depopulate();

		$this->assertEquals(0, count(BookPeer::doSelect(new Criteria())), "Expect book table to be empty.");
		$this->assertEquals(0, count(AuthorPeer::doSelect(new Criteria())), "Expect author table to be empty.");
		$this->assertEquals(0, count(PublisherPeer::doSelect(new Criteria())), "Expect publisher table to be empty.");
		$this->assertEquals(0, count(ReviewPeer::doSelect(new Criteria())), "Expect review table to be empty.");
		$this->assertEquals(0, count(MediaPeer::doSelect(new Criteria())), "Expect media table to be empty.");
		$this->assertEquals(0, count(BookstoreEmployeePeer::doSelect(new Criteria())), "Expect bookstore_employee table to be empty.");
		$this->assertEquals(0, count(BookstoreEmployeeAccountPeer::doSelect(new Criteria())), "Expect bookstore_employee table to be empty.");

		BookPeer::clearInstancePool();
		$this->assertEquals(0, count(BookPeer::$instances), "Expected 0 Book instances after clearInstancePool()");

		AuthorPeer::clearInstancePool();
		$this->assertEquals(0, count(AuthorPeer::$instances), "Expected 0 Author instances after clearInstancePool()");

		PublisherPeer::clearInstancePool();
		$this->assertEquals(0, count(PublisherPeer::$instances), "Expected 0 Publisher instances after clearInstancePool()");

		ReviewPeer::clearInstancePool();
		$this->assertEquals(0, count(ReviewPeer::$instances), "Expected 0 Review instances after clearInstancePool()");

		MediaPeer::clearInstancePool();
		$this->assertEquals(0, count(MediaPeer::$instances), "Expected 0 Media instances after clearInstancePool()");

		BookstoreEmployeePeer::clearInstancePool();
		$this->assertEquals(0, count(BookstoreEmployeePeer::$instances), "Expected 0 BookstoreEmployee instances after clearInstancePool()");

		BookstoreEmployeeAccountPeer::clearInstancePool();
		$this->assertEquals(0, count(BookstoreEmployeeAccountPeer::$instances), "Expected 0 BookstoreEmployeeAccount instances after clearInstancePool()");

		parent::tearDown();
	}

}
