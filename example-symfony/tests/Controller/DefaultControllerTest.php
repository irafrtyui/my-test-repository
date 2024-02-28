<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class DefaultControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = $this->createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertStringContainsString('Our Store', $content);
        $this->assertStringContainsString('Secure payment', $content);

    }

    public function testLatestNews()
    {
        $client = $this->createClient();
        $client->request('GET', '/default/latestNews');
        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertStringContainsString('New Angular Notebook', $content);
        $this->assertStringContainsString('New womens collection', $content);

    }

    //  public function testCommentsForm()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/default/newsOne/{id}');

    //    $buttonCrawlerNode = $crawler->selectButton('submit');
    //   $form = $buttonCrawlerNode->form();

    //    $client->submit($form, [
    //       'name'    => 'Mark',
    //      'comment' => 'Thank You!',
    //  ]);
    // }

 /*   public function testCommentsForm()
    {
        $client = static::createClient();
        $client->request('POST', '/default/newsOne/{id}');
        self::assertSame(200, $client->getResponse()->getStatusCode());


        $form = $client->getCrawler()->filter('form[name="comments_form"]')->form();
        $values = $form->getPhpValues();

        $formData = ['name' => 'Mark', 'comment' => 'Thank You!'];
        $values['comments_form'] = array_merge($values['comments_form'], $formData);

        $client->request(
            $form->getMethod(),
            $form->getUri(),
            $values,
            $form->getPhpFiles()
        );
    }
*/

    }

