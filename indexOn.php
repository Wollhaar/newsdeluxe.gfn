<?php



require_once 'conf.php';

use Entities\News,
 Entities\Category,
 Entities\User;

$action = filter_input(INPUT_GET, 'a');


switch ($action) {
    case 'all':
        
        $news = $em->getRepository('Entities\News')->findAll();
        
        $tpl = VIEW_PATH.'news_list.html';
        break;
    
    case 'save':
        $data = $_POST;
        $id = filter_input(INPUT_POST, 'id');
       try{
        if(empty($id)){
            $news = new News();
            $news->setHeadline($data['headline']);
            $news->setTextbody($data['textbody']);
            $news->setImage('');
            
            $user = $em->find('Entities\User', $_SESSION['user']->getId());
            $news->setUser($user);
            
            $category = $em->find('Entities\Category', $data['category']);
            $news->setCategory($category);
            
            $news->setStatus($data['status']); 
            $em->persist($news);
        } else{
            $news = $em->find('Entities\News', $id);
            $news->setHeadline($data['headline']);
            $news->setTextbody($data['textbody']); 
            $news->setImage('');
            $news->setStatus($data['status']);
            $category = $em->find('Entities\Category', $data['category']);
            $news->setCategory($category);
        }
        $em->flush();
} 
 catch (Exception $e){
    
    echo $e->getMessage();
 }
         
        header('location: ?a=all');
        die();

        break;
        
    case 'all':
        //$news = '%'.filter_input(INPUT_POST).'%';
        if(isset($_SESSION['user']) && ($_SESSION['user'] instanceof User)){
        $query = $em->createQuery('SELECT n FROM Entities\News n ORDER BY n.created DESC');
        } else {
        $query = $em->createQuery('SELECT n FROM Entities\News n WHERE n.status = 1 ORDER BY n.created DESC');
        }
        $news = $query->getResult();
        $tpl = VIEW_PATH.'news_list.html';
        break;
    
    case 'update':
        $data = $_POST;
        $sql = 'UPDATE news SET headline=?, textbody=?, status=? WHERE id=? LIMIT 1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($data['headline'],
            $data['textbody'],
            $data['status'],
            $data['id']));
        
        $id = filter_input(INPUT_POST, 'id');
        $news = $em->find('Entities\News', $id);
        $news->setHeadline($data['headline']);
        $news->setTextbody($data['textbody']);
        $news->setStatus(['status']); 
        $em->flush();
        header('location: index.php');
        break;
    
    case 'search':
        $input = '%' . filter_input(INPUT_POST, 'search') . '%';
        
        //Querybuilder
        $query = $em->createQueryBuilder()
                ->select('n')
                ->from('Entities/News', 'n')
                ->where('n.headline LIKE :headline')
                ->orWhere('n.textbody LIKE :textbody')
                ->orderBy('n.created', 'DESC')
                ->setParameter('headline', $input)
                ->setParameter('textbody', $input)
                ->getQuery();
        $news = $query->getResult();
        
        $tpl = VIEW_PATH.'news_list.html';
        break;
    case 'new':
        $obj = new News();
        $news = new Entities\News();
        $tpl = VIEW_PATH.'news_form.html';
        $categories = $em->getRepository('Entities\Category')->findAll();
        
        $output = '<form action="index.php?a=save" method="post" enctype="multipart/form-data">
                        <input type="text" name="headline" placeholder="Titel" /><br/>
                        <textarea name="textbody" placeholder="Nachricht eingeben"></textarea><br/>
                        <input type="file" name="image" accept="image/*" /><br/>
                        <select name="status">
                            <option value="0">nicht sichtbar</option>
                            <option value="1">publiziert</option>
                            <option value="2">gesperrt</option>
                        </select><br/>
                        <button type="submit">Speichern</button>
                   </form>';
        break;
    case 'delete':
        $id = filter_input(INPUT_POST, 'id');
        $news = $em->find('Entities\News', $id);
        
        $em->remove($news);
        $em->flush();
        
        header('location: index.php?a=all');
        break;
    case 'edit':
        $output = 'Nachricht bearbeiten';
        $id = filter_input(INPUT_POST, 'id');
        
        $news = $em->find('Entities\News', $id);
        $categories = $em->getRepository('Entities\Category')->findAll();
        
        
        $tpl = VIEW_PATH.'news_form.html';
        
        
        break;

    case 'login':
            $email = trim(filter_input(INPUT_POST, 'email'));
            $password = md5(trim(filter_input(INPUT_POST, 'password')));
            
            $query = $em->createQuery('SELECT u FROM Entities\User u WHERE u.email = :email AND u.password = :password')->setParameter('email', $email)->setParameter('password', $password);
            

        try {
            $user = $query->getSingleResult();
            $_SESSION['user'] = $user;
            header('location: ?a=all');
        } catch (Exception $ex) {
            header('location: ?a=all&e=1');
        }


        break;

    case 'logout':
        unset($_SESSION['user']);
        header('location: index.php?a=all');
        break;

    default :
        if(isset($_SESSION['user']) && ($_SESSION['user'] instanceof User)){
        $query = $em->createQuery('SELECT n FROM Entities\News n ORDER BY n.created DESC');
        } else {
        $query = $em->createQuery('SELECT n FROM Entities\News n WHERE n.status = 1 ORDER BY n.created DESC');
        }
        $query->setMaxResults(3);
        $news = $query->getResult();
        $news = $em->getRepository('Entities\News')->findAll();
        $tpl = VIEW_PATH.'news_list.html';
}

include_once 'view/standard.html';
