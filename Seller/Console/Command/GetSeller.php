<?php

namespace Training\Seller\Console\Command;

use Magento\Framework\Exception\LocalizedException;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Output\OutputInterface;
use Training\Seller\Api\SellerRepositoryInterface;

class GetSeller extends Command
{


    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        string $name = null
    )
    {
        $this->sellerRepository =$sellerRepository;
        parent::__construct($name);
    }

    private const NAME = 'name';


    protected function configure(): void

    {

        $this->setName('training:seller:get');

        $this->setDescription('This is my first console command.');

        $this->addOption(

            self::NAME,

            null,

            InputOption::VALUE_REQUIRED,

            'Name'

        );


        parent::configure();

    }


    /**

     * Execute the command

     *

     * @param InputInterface $input

     * @param OutputInterface $output

     *

     * @return int

     */

    protected function execute(InputInterface $input, OutputInterface $output): int

    {

        $exitCode = 0;



        if ($name = $input->getOption(self::NAME)) {

            $output->writeln('<info>Provided name is `' . $name . '`</info>');

        }


        $output->writeln('<info>Success message.</info>');

        $output->writeln('<info>Seller name : `' . $this->sellerRepository->getById(2)->getName() . '`</info>');

        $output->writeln('<comment>Some comment.</comment>');


        try {

            if (rand(0, 1)) {

                throw new LocalizedException(__('An error occurred.'));

            }

        } catch (LocalizedException $e) {

            $output->writeln(sprintf(

                '<error>%s</error>',

                $e->getMessage()

            ));

            $exitCode = 1;

        }



        return $exitCode;

    }
}
