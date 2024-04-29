<?php

/*
 * Developed by wilowi
 */

/**
 * Description of pdf
 *
 * @author Sandra <wilowi.com>
 */
class PDF extends FPDF {

	function MultiCellIndent($w, $h, $txt, $border = 0, $align = 'J', $fill = false, $indent = 0) {
		//Output text with automatic or explicit line breaks
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;

		$wFirst = $w - $indent;
		$wOther = $w;

		$wmaxFirst = ($wFirst - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$wmaxOther = ($wOther - 2 * $this->cMargin) * 1000 / $this->FontSize;

		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 && $s[$nb - 1] == "\n")
			$nb--;
		$b = 0;
		if ($border) {
			if ($border == 1) {
				$border = 'LTRB';
				$b = 'LRT';
				$b2 = 'LR';
			} else {
				$b2 = '';
				if (is_int(strpos($border, 'L')))
					$b2 .= 'L';
				if (is_int(strpos($border, 'R')))
					$b2 .= 'R';
				$b = is_int(strpos($border, 'T')) ? $b2 . 'T' : $b2;
			}
		}
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$nl = 1;
		$first = true;
		while ($i < $nb) {
			//Get next character
			$c = $s[$i];
			if ($c == "\n") {
				//Explicit line break
				if ($this->ws > 0) {
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				$this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				$nl++;
				if ($border && $nl == 2)
					$b = $b2;
				continue;
			}
			if ($c == ' ') {
				$sep = $i;
				$ls = $l;
				$ns++;
			}
			$l += $cw[$c];

			if ($first) {
				$wmax = $wmaxFirst;
				$w = $wFirst;
			} else {
				$wmax = $wmaxOther;
				$w = $wOther;
			}

			if ($l > $wmax) {
				//Automatic line break
				if ($sep == -1) {
					if ($i == $j)
						$i++;
					if ($this->ws > 0) {
						$this->ws = 0;
						$this->_out('0 Tw');
					}
					$SaveX = $this->x;
					if ($first && $indent > 0) {
						$this->SetX($this->x + $indent);
						$first = false;
					}
					$this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
					$this->SetX($SaveX);
				} else {
					if ($align == 'J') {
						$this->ws = ($ns > 1) ? ($wmax - $ls) / 1000 * $this->FontSize / ($ns - 1) : 0;
						$this->_out(sprintf('%.3f Tw', $this->ws * $this->k));
					}
					$SaveX = $this->x;
					if ($first && $indent > 0) {
						$this->SetX($this->x + $indent);
						$first = false;
					}
					$this->Cell($w, $h, substr($s, $j, $sep - $j), $b, 2, $align, $fill);
					$this->SetX($SaveX);
					$i = $sep + 1;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				$nl++;
				if ($border && $nl == 2)
					$b = $b2;
			} else
				$i++;
		}
		//Last chunk
		if ($this->ws > 0) {
			$this->ws = 0;
			$this->_out('0 Tw');
		}
		if ($border && is_int(strpos($border, 'B')))
			$b .= 'B';
		$this->Cell($w, $h, substr($s, $j, $i), $b, 2, $align, $fill);
		$this->x = $this->lMargin;
	}

	/*	 * **********************************************************
	 *                                                           *
	 *    MultiCell with bullet (array)                          *
	 *                                                           *
	 *    Requires an array with the following  keys:            *
	 *                                                           *
	 *        Bullet -> String or Number                         *
	 *        Margin -> Number, space between bullet and text    *
	 *        Indent -> Number, width from current x position    *
	 *        Spacer -> Number, calls Cell(x), spacer=x          *
	 *        Text -> Array, items to be bulleted                *
	 *                                                           *
	 * ********************************************************** */

	function MultiCellBltArray($w, $h, $blt_array, $border = 0, $align = 'J', $fill = false) {
		if (!is_array($blt_array)) {
			die('MultiCellBltArray requires an array with the following keys: bullet,margin,text,indent,spacer');
			exit;
		}

		//Save x
		$bak_x = $this->x;

		for ($i = 0; $i < sizeof($blt_array['text']); $i++) {
			//Get bullet width including margin
			$blt_width = $this->GetStringWidth($blt_array['bullet'] . $blt_array['margin']) + $this->cMargin * 2;

			// SetX
			$this->SetX($bak_x);

			//Output indent
			if ($blt_array['indent'] > 0)
				$this->Cell($blt_array['indent']);

			//Output bullet
			$this->Cell($blt_width, $h, $blt_array['bullet'] . $blt_array['margin'], 0, '', $fill);

			//Output text
			$this->MultiCell($w - $blt_width, $h, $blt_array['text'][$i], $border, $align, $fill);

			//Insert a spacer between items if not the last item
			if ($i != sizeof($blt_array['text']) - 1)
				$this->Ln($blt_array['spacer']);

			//Increment bullet if it's a number
			if (is_numeric($blt_array['bullet']))
				$blt_array['bullet'] ++;
		}

		//Restore x
		$this->x = $bak_x;
	}

	function WriteHTML($html) {
		// HTML parser
		$html = str_replace("\n", ' ', $html);
		$a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
		foreach ($a as $i => $e) {
			if ($i % 2 == 0) {
				// Text
				if ($this->HREF)
					$this->PutLink($this->HREF, $e);
				else
					$this->Write(5, $e);
			}
			else {
				// Tag
				if ($e[0] == '/')
					$this->CloseTag(strtoupper(substr($e, 1)));
				else {
					// Extract attributes
					$a2 = explode(' ', $e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach ($a2 as $v) {
						if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
							$attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag, $attr);
				}
			}
		}
	}

	function OpenTag($tag, $attr) {
		// Opening tag
		if ($tag == 'B' || $tag == 'I' || $tag == 'U')
			$this->SetStyle($tag, true);
		if ($tag == 'A')
			$this->HREF = $attr['HREF'];
		if ($tag == 'BR')
			$this->Ln(5);
	}

	function CloseTag($tag) {
		// Closing tag
		if ($tag == 'B' || $tag == 'I' || $tag == 'U')
			$this->SetStyle($tag, false);
		if ($tag == 'A')
			$this->HREF = '';
	}

	function SetStyle($tag, $enable) {
		// Modify style and select corresponding font
		$this->$tag += ($enable ? 1 : -1);
		$style = '';
		foreach (array('B', 'I', 'U') as $s) {
			if ($this->$s > 0)
				$style .= $s;
		}
		$this->SetFont('', $style);
	}

	function PutLink($URL, $txt) {
		// Put a hyperlink
		$this->SetTextColor(0, 0, 255);
		$this->SetStyle('U', true);
		$this->Write(5, $txt, $URL);
		$this->SetStyle('U', false);
		$this->SetTextColor(0,0,255);
	}
	
	function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
	
	function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

}
