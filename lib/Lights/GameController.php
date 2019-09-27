<?php
/**
 * Main game controller. Handles post from the game page.
 * @author Charles B. Owen
 */

namespace Lights;

/**
 * Main game controller. Handles post from the game page.
 */
class GameController extends Controller {
	/**
	 * GameController constructor.
     * @param Lights $lights Lights object
     * @param array $post $_POST
     */
    public function __construct(Lights $lights, array $post) {
        parent::__construct($lights);

        $game = $lights->getGame();

		// Default will be to return to the game page
		$this->setRedirect("../game.php");

		if(isset($post['check'])) {
            $game->setChecking(true);
        }

		// Clear any messages
		$lights->setMessage(null);

		// Handle clicks on cells
		if(isset($post['cell'])) {
			$s = explode(',', strip_tags($post['cell']));
			$row = $s[0];
			$col = $s[1];

			$game->click($row, $col);
            $this->result = json_encode(array('ok' => true, 'cells' => $lights->getGame()->presentGame()));
            //$this->result = json_encode(array('ok' => true, 'table' => $game->presentGame()));

            //$view = new GameView($lights);
            //$this->result = json_encode(array('ok' => true, 'table' => $view->present_body()));
//			if($game->solved()) {
//				$this->setRedirect("../solved.php");
//				return;
//			}
		}
        $view = new GameView($lights);

        //


		//
		// Clearing logic
		//
		if($game->isClearing()) {
			if(isset($post['yes'])) {
				$game->clear();
			}

			$game->setClearing(false);
		}

		if(isset($post['clear'])) {
			$game->setClearing(true);
		}

		//
		// Solving logic
		//
		if($game->isSolving()) {
			if(isset($post['yes'])) {
				$game->solve();
			}

			$game->setSolving(false);
		}

		if(isset($post['solve'])) {
			$game->setSolving(true);
		}
	}
}