<?php
/**
 * Use this to switch connection:
 * $this->get('doctrine.dbal.dynamic_connection')->forceSwitch('WtsMara', 'root', 'ophthalamia');
 * 
 * @TODO Трябва да преместя конфигурацията от глобалния config.yml в този бъндъл.
 *      И съшто не можах да конфигорирам втория ентити менажер който да използва този конекшън
        
        doctrine:
           orm:
               default_entity_manager: default
               entity_managers:
                   default:
                       connection: default
                       mappings:
                           AppBundle:  ~
                           AcmeStoreBundle: ~
                   customer:
                       connection: customer
                       mappings:
                           AcmeCustomerBundle: ~
 */
namespace IA\Bundle\DoctrineBundle\Connection;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Events;
use Doctrine\DBAL\Event\ConnectionEventArgs;

class ConnectionWrapper extends Connection
{

    const SESSION_ACTIVE_DYNAMIC_CONN = 'active_dynamic_conn';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var bool
     */
    private $_isConnected = false;

    /**
     * @param Session $sess
     */
    public function setSession(Session $sess)
    {
        $this->session = $sess;
    }

    public function forceSwitch($dbName, $dbUser, $dbPass)
    {
        if ($this->session->has(self::SESSION_ACTIVE_DYNAMIC_CONN)) {
            $current = $this->session->get(self::SESSION_ACTIVE_DYNAMIC_CONN);
            if ($current[0] === $dbName) {
                return true;
            }
        }

        $this->session->set(self::SESSION_ACTIVE_DYNAMIC_CONN, [
            $dbName,
            $dbUser,
            $dbPass
        ]);

        if ($this->isConnected()) {
            $this->close();
        }
        
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function connect()
    {
        if (!$this->session->has(self::SESSION_ACTIVE_DYNAMIC_CONN)) {
            throw new \InvalidArgumentException('You have to inject into valid context first');
        }
        if ($this->isConnected()) {
            return true;
        }

        $driverOptions = isset($params['driverOptions']) ? $params['driverOptions'] : array();

        $params = $this->getParams();
        $realParams = $this->session->get(self::SESSION_ACTIVE_DYNAMIC_CONN);
        $params['dbname'] = $realParams[0];
        $params['user'] = $realParams[1];
        $params['password'] = $realParams[2];

        $this->_conn = $this->_driver->connect($params, $params['user'], $params['password'], $driverOptions);

        if ($this->_eventManager->hasListeners(Events::postConnect)) {
            $eventArgs = new ConnectionEventArgs($this);
            $this->_eventManager->dispatchEvent(Events::postConnect, $eventArgs);
        }

        $this->_isConnected = true;

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isConnected()
    {
        return $this->_isConnected;
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        if ($this->isConnected()) {
            parent::close();
            $this->_isConnected = false;
        }
    }

}
